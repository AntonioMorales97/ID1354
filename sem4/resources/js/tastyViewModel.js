/* Called when document finished loading */
$(document).ready(function () {

    function TastyViewModel(){
        var self = this;

        self.loggedIn = ko.observable(false);
        self.username = ko.observable(); //The username the user types in
        self.password = ko.observable(); //The password the user types in
        self.messageContent = ko.observable(); //Message to user
        self.loginForm = ko.observable(false);

        self.comments = ko.observableArray();
        self.commentMessage = ko.observable(""); //The comment the user types in
        self.maxCommentID = 0; //The max id of the last posted comment

        /**
         * This method will peform the login process after a user has entered
         * username and password.
         */
        self.login = function(){
            if(isEmptyOrWhitespace(self.username()) || isEmptyOrWhitespace(self.password())){
                alert("Please fill out all fields!");
            } else if(containsWhitespace(self.username()) || containsWhitespace(self.password())){
                alert("Username and password cannot contains any whitespaces!")
                self.password("");
            } else{
                $.post("login_user.php", {username:self.username(), password:self.password()}, function(data){
                    if(data == "fail"){
                        alert("Username and password do not match!");
                        self.password("");
                    } else if(data == "error"){
                        alert("Something went wrong when connecting to the database. Please contact Antonio!");
                    } else if(data == "empty"){
                        /*Will never come here*/
                    } else if(data == "success"){
                        self.loginForm(false);
                        self.loggedIn(true);
                        sessionStorage.setItem("username", self.username());
                        self.messageContent('<div class="success"><p>Login success!</p></div><script>$(function(){$(".success").fadeOut(3000)});</script>');
                        
                        self.loadRecipeComments(); //to see if the logged in user has some posted comments
                    }
                });
            }
            self.messageContent("");    
        }

        /**
         * This function will check if the given string is empty or contains any whitespace.
         * @param {String} str A string.
         * @return true if it is empty or contains whitespace; false otherwise.
         */
        function isEmptyOrWhitespace(str){
            return !str || !str.trim();
        }

        /**
         * This function will only check if the given string contains any whitespace.
         * @param {String} str A string
         * @return true if it contains whitespace; false otherwise.
         */
        function containsWhitespace(str){
            if (/\s/.test(str)) {
                return true;
            }
            return false;
        }

        /**
         * Performs the logout process for the user. 
         */
        self.logout = function(){
            $.get("logout_user.php", function(){
                self.loggedIn(false);
                sessionStorage.removeItem("username");
                self.messageContent('<div class="success"><p>Bye bye!</p></div><script>$(function(){$(".success").fadeOut(3000)});</script>');
            });
            self.messageContent("");
        }

        /**
         * Opens the login form.
         */
        self.openLogin = function(){
            self.loginForm(true);
        }

        /**
         * Closes the login form.
         */
        self.closeLogin = function(){
            self.loginForm(false);
        }

        // Get the login window
        var loginForm = document.getElementById('loginForm');

        //Close if the user clicks outside the window
        window.onclick = function() {
            if (event.target == loginForm) {
                self.loginForm(false);
            }
        }

        /**
         * Loads the comments for a recipe through an AJAX request and stores the comments in
         * an observable array. The method then calls the 'getNewComments' method for long polling.
         */
        self.loadRecipeComments = function(){
            if(window.location.href.indexOf("home") > -1 || window.location.href.indexOf("calendar") > -1 || window.location.href.indexOf("signup") > -1){
                return;
            }

            self.comments.removeAll(); 
            var recipePage = decodeURI(window.location.search.replace("?page=", ""));
            $.post("get_comments.php", {currentRecipe:recipePage}, function(storedComments){
                var comments = JSON.parse(storedComments);

                for(var i = 0; i < comments.length; i++){
                    var comment = comments[i];

                    comment.iWroteThis = (comment.username == sessionStorage.getItem("username"));

                    if(self.maxCommentID < comment.comment_id){
                        self.maxCommentID = comment.comment_id;
                    }

                    self.comments.unshift(comment);
                }
                self.getNewComments();
            });
            
        }

        /**
         * Uses long polling for loading new posted comments in the current recipe page
         * and displaying it for the user without refreshing the page.
         */
        self.getNewComments = function(){
            var recipePage = decodeURI(window.location.search.replace("?page=", ""));
            $.post("get_new_comments.php", {recipe_title:recipePage, currentMaxCommentID:self.maxCommentID}, function(latestComment){
                var comment = JSON.parse(latestComment);
                self.maxCommentID = comment.comment_id;
                comment.iWroteThis = (comment.username == sessionStorage.getItem("username"));
                self.comments.unshift(comment);
                self.getNewComments();
            });
        }

        /**
         * Sends an AJAX request to delete the comment and also removes the comment from
         * the observable array.
         */
        self.deleteComment = function(comment){
            $.post("delete_comment.php", {user_id:comment.user_id, comment_id:comment.comment_id}, function(){
                self.comments.remove(comment);
            });    
        }

        /**
         * Posts a comment by sending it with an AJAX request. The comment is then loaded with long polling
         * in the 'getNewComments' method. 
         */
        self.postComment = function(){
            var recipe = decodeURI(window.location.search.replace("?page=", ""));
            
            $.post("set_comment.php", {username:sessionStorage.getItem("username"), comment:self.commentMessage(), recipe_title:recipe}, function(){
                self.commentMessage("");
            });
        }

        self.loadRecipeComments();
    }

    var tastyViewModel = new TastyViewModel();
    ko.applyBindings(tastyViewModel);

    /* This function will check if the user is logged in between pages */
    $(function(){
        var loggedInUser = sessionStorage.getItem("username"); //returns NULL if empty.
        if(loggedInUser != null){
            tastyViewModel.loggedIn(true);
        }
    });

});