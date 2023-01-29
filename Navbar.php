<nav id='menu'>
    <input type='checkbox' id='responsive-menu'><label></label>
    <ul>
        <li><a href='http://localhost:8080/FTK/Project/homepage.php'>Home</a></li>
        <li><a href="AdminPanel.php">Admin Panel</a></li>
        <li><a class='dropdown-arrow' href='#'>Books</a>
            <ul class='sub-menus'>
                <li><a href='http://localhost:8080/FTK/Project/AddBook.php'>Add</a></li>

                <li><a href='http://localhost:8080/FTK/Project/RemoveBook.php'>Remove</a></li>

                <li><a href="http://localhost:8080/FTK/Project/IssueBook.php">Issue</a></li>

                <li><a href="http://localhost:8080/FTK/Project/ReturnBook.php">Return</a></li>

                <li><a href="http://localhost:8080/FTK/Project/SearchBooks.php">Search</a></li>

                <li><a href='http://localhost:8080/FTK/Project/IssuedBooks.php'>Issued</a></li>
                <li><a href="http://localhost:8080/FTK/Project/NotReturned.php">Not Returned yet</a></li>

                <li><a href='http://localhost:8080/FTK/Project/DisplayBooksToAdmin.php'>All details</a></li>

                <li><a title="Change Total,Issued,Not Returned Books" href='http://localhost:8080/FTK/Project/ChangeBooksInfo.php'>Change Info</a></li>
                <li><a href="#" title="Reset Issued,Not Returned Books to 0" onclick="ResetBooksInfo();">Reset Info</a></li>
            </ul>
        <li><a class='dropdown-arrow' href='#'>Users</a>
            <ul class='sub-menus'>
                <li><a href='http://localhost:8080/FTK/Project/AddUser.php'>Add</a></li>
                <li><a href='http://localhost:8080/FTK/Project/RemoveUser.php'>Remove</a></li>
                <li><a href='http://localhost:8080/FTK/Project/AllUsers.php'>All users</a></li>
            </ul>
        </li>
        </li>
        <li><a href='http://localhost:8080/FTK/Project/Admins.php'>Admins</a></li>


    </ul>
</nav>