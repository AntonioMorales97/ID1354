<?php
    include 'fragments/header.php';
?> 
    <div class="calendar-header">
        <h2>Calendar <i class="fas fa-calendar-alt"></i></h2>
        <h3>November</h3>
    </div>
    <div class="calendar">
        <!--First week-->
        <div class="week">
            <div class="day"><p>Monday 1</p></div>
            <div class="day"><p>Tuesday 2</p></div>
            <div class="day"><p>Wednesday 3</p></div>
            <div class="day"><p>Thursday 4</p>
                <a href="recipe.php?name=Glazed%20Meatballs">
                    <img class="img-responsive" src="images/smallmeatballs.jpg" alt="Go to meatball recipe">
                </a>
            </div>
            <div class="day"><p>Friday 5</p></div>
            <div class="day weekend"><p>Saturday 6</p></div>
            <div class="day weekend"><p>Sunday 7</p></div>
        </div>

        <!--Second week-->
        <div class="week">
            <div class="day"><p>Monday 8</p></div>
            <div class="day"><p>Tuesday 9</p></div>
            <div class="day"><p>Wednesday 10</p></div>
            <div class="day"><p>Thursday 11</p></div>
            <div class="day"><p>Friday 12</p></div>
            <div class="day weekend"><p>Saturday 13</p></div>
            <div class="day weekend"><p>Sunday 14</p></div>
         </div>

         <!--Third week-->
        <div class="week">
            <div class="day"><p>Monday 15</p></div>
            <div class="day"><p>Tuesday 16</p></div>
            <div class="day"><p>Wednesday 17</p>
                <a href="recipe.php?name=Swedish%20Pancakes">
                    <img class="img-responsive" src="images/smallpancakes.jpeg" alt="Go to pancake recipe">
                </a>
            </div>
            <div class="day"><p>Thursday 18</p></div>
            <div class="day"><p>Friday 19</p></div>
            <div class="day weekend"><p>Saturday 20</p></div>
            <div class="day weekend"><p>Sunday 21</p></div>
        </div>

        <!--Fourth week-->
        <div class="week">
            <div class="day"><p>Monday 22</p></div>
            <div class="day"><p>Tuesday 23</p></div>
            <div class="day"><p>Wednesday 24</p></div>
            <div class="day"><p>Thursday 25</p></div>
            <div class="day"><p>Friday 26</p></div>
            <div class="day weekend"><p>Saturday 27</p></div>
            <div class="day weekend"><p>Sunday 28</p></div>
        </div>

        <!--Fifth week-->
        <div class="week">
                <div class="day"><p>Monday 29</p></div>
                <div class="day"><p>Tuesday 30</p></div>
                <div class="day"><p>Wednesday 31</p></div>
                <div class="day next-month"><p>Thursday 1</p></div>
                <div class="day next-month"><p>Friday 2</p></div>
                <div class="day weekend next-month"><p>Saturday 3</p></div>
                <div class="day weekend next-month"><p>Sunday 4</p></div>
        </div>

    </div>    
<?php
    include 'fragments/footer.php';
?>
