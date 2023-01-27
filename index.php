<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>DeBo</title>
<!--    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="0"> -->
    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/bookingmenu.css">
    <link rel="stylesheet" href="/css/floor.css">
    <link rel="stylesheet" href="/css/loader.css">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" href="/css/profilewindow.css">
    <link rel="stylesheet" href="/css/sidebar.css">
<!--    <link rel="manifest" href="/manifest.json"> -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="DeBo">
    <link rel="apple-touch-icon" href="/icons/apple-icon-57x57.png" sizes="57x57">
    <link rel="apple-touch-icon" href="/icons/apple-icon-60x60.png" sizes="60x60">
    <link rel="apple-touch-icon" href="/icons/apple-icon-72x72.png" sizes="72x72">
    <link rel="apple-touch-icon" href="/icons/apple-icon-76x76.png" sizes="76x76">
    <link rel="apple-touch-icon" href="/icons/apple-icon-114x114.png" sizes="114x114">
    <link rel="apple-touch-icon" href="/icons/apple-icon-120x120.png" sizes="120x120">
    <link rel="apple-touch-icon" href="/icons/apple-icon-144x144.png" sizes="144x144">
    <link rel="apple-touch-icon" href="/icons/apple-icon-152x152.png" sizes="152x152">
    <link rel="apple-touch-icon" href="/icons/apple-icon-180x180.png" sizes="180x180">
    <meta name="msapplication-TileImage" content="/icons/app-icon-144x144.png">
    <meta name="msapplication-TileColor" content="#fff">
</head>
<body>
    <div id="modal" class="modal loader-modal"></div>
    <div id="loader" class="loader">
		<span>D</span>
        <span>e</span>
        <span>B</span>
        <span>o</span>
    </div>
<?php

    function loggedin($username, $username_name, $hasPicture) {
        global $conn;
        echo "<script>console.log('Succesfully logged in username: $username_name');</script>";
?>
        <div class="floor-container" id="floor-container">
            <img src="/images/main-image-shrinked.jpg" class="floor-img" alt="Floor Plan">
            <div class="burgermenu-container" id="burger-menu-button" onclick="OpenSideBar()">
                <svg width="100%" height="100%">>
                    <rect x="25%" y="30%" width="50%" height="10%" rx="12%"></rect>
                    <rect x="25%" y="45%" width="50%" height="10%" rx="12%"></rect>
                    <rect x="25%" y="60%" width="50%" height="10%" rx="12%"></rect>
                </svg>
            </div>
            <div class="booker-view-container" id="view-button" onclick="ChangeDesksView()">
            </div>
            <!-- <img id="image1" src="/images/booker_M.png" class="floor-booker-img button-desk1"> -->
            <input type="date" id="datepicker" class="datepicker" min="2022-01-01" max="2030-12-31">
        </div>
        <div id="sidebar-container" class="sidebar-container">
            <div id="sidebar" class="sidebar">
                <!-- <h2 id="SideBarTitle">Desk</h2> -->
                <h2><span style="color:black;">De</span><span>sk</span></h2>
                <!-- <h2 id="SideBarTitle">Booking</h2> -->
                <h2><span style="color:black;">Bo</span><span>oking</span></h2>
                <img id="sidebar-image-profile" src="/images/booker_view_button.png" class="sidebar-booker-img" onclick="ProfileWindow_Open()">
                <p id="SideBarUserName" onclick="ProfileWindow_Open()">User Name</p>
                <p id="sidebar-UserName-Hidden" style="display: none;" >User Name</p>
                <p id="sidebar-HasPicture-Hidden" style="display: none;" >yes</p>
                <!-- <button class="buttons sidebar-button">Profile</button> -->
                <hr>
                <button class="buttons sidebar-button" id="sign-out">Sign-Out</button>
            </div>
        </div>
        <form id="booking-menu" class="booking-menu animate" action="" method="post">
            <h2 id="booking-menu-label-desk-number">Desk Number 00</h2>
            <div id="booking-circle" class="booking-circle">Free</div>
            <div class="booking-img-container">
                <img id="booking-img" alt="Login-Logo" class="booking-img">
    	    </div>
            <div>
                <p id="booking-menu-label-booker">Booker Name</p>
                <p id="booking-menu-label-username-hidden" style="display: none;">UserName</p>
                <p id="booking-menu-bookstate-message" style="font-size: 10px;"></p>
            </div>
            <div>
                <button class="buttons button-booking-book" id="button-booking-book" onclick="BookDesk(event)">Book</button>
                <button class="buttons button-booking-close" id="button-booking-close" onclick="CloseBookingMenu(event)">Close</button>
    		</div>
        </form>
        <div id="profile-window" class="profile-window">
            <a href="#" class="profile-window-back" onClick="ProfileWindow_Close(); OpenSideBar();">&#8249;</a>
            <div id="profile-window-container" class="profile-window-container">
                <h2>Profile</h2>
                <div class="profile-inputfields-container">
			        <label for="ProfileWindowUserName"><b>User Name:</b></label>
      		        <input type="text" placeholder="User Name" name="ProfileWindowUserName" id="ProfileWindowUserName" disabled="disabled">
      		        <label for="ProfileWindowFullName"><b>Full Name:</b></label>
      		        <input type="text" placeholder="Full Name" name="ProfileWindowFullName" id="ProfileWindowFullName" disabled="disabled">
                </div>
      		    <hr>
      		    <label for="ProfileWindowUserImage"><b>User Image:</b></label>
                <div style="padding-top: 10px;">
                    <div id="profile-window-noimage-container" style="padding-bottom: 10px;" onClick="updateDB_ProfilePicture('none')">
                        <input type="radio" name="profile-window-images" id="profile-window-noimage">No image</input>
                    </div>
      		        <input type="radio" name="profile-window-images" id="profile-window-image1" onClick="updateDB_ProfilePicture('female')">
      		            <img src="/images/booker_F.png" class="profile-window-img" onClick="updateDB_ProfilePicture('female')">
      		        </input>
      		        <input type="radio" name="profile-window-images" id="profile-window-image2" onClick="updateDB_ProfilePicture('male')">
      		            <img src="/images/booker_M.png" class="profile-window-img" onClick="updateDB_ProfilePicture('male')">
      		        </input>
      		    </div>
      		    <div>
      		        <input type="radio" name="profile-window-images" id="profile-window-image3">
      		            <img src="/images/booker_view_button.png" id="profile-window-img3" class="profile-window-img" onClick="updateDB_ProfilePicture('custom')">
      		        </input>
			    </div>
                <button class="profile-window-button-upload" id="upload-image" onclick="FileUploadWindow()">
                    Upload New Image
                    <input type="file" id="file-upload" style="display: none;" accept="image/*">
                </button>
			    <hr>
			    <span class="highlightYellow" id="profile-window-span"></span>
			    <!--
			    <img id="myCanvas">
                <div>
                    <button type="submit" class="buttons button-booking-book" name="button-profile-save" onclick="SaveImage()">Save</button>
                    <button class="buttons button-booking-close" id="button-profile-close" onclick="ProfileWindow_Close()">Cancel</button>
    		    </div>
    		    -->
    		</div>
        </div>
<?php
        echo "<script>
            document.getElementById('SideBarUserName').innerHTML = '$username_name';
            //document.getElementById('sidebar-image-profile').src='/images/Users/' + '$username'.toLowerCase() + '.png';
            document.getElementById('sidebar-UserName-Hidden').innerHTML = '$username';
            document.getElementById('sidebar-HasPicture-Hidden').innerHTML = '$hasPicture';
        </script>";
    }
//Login.php--------------------------------------------------------------------------------
    include('dbcon.php');
    $cookie_name = "autologin";
    $cookie_value = $_COOKIE[$cookie_name];
    if(!empty($cookie_value)) {
// Query database if autologincookie found
        $query_autologin = $conn->query("SELECT * FROM Users WHERE AutologinCookie = '$cookie_value'");
        $found_autologin = $query_autologin->rowCount();
        if ($found_autologin > 0) {
            $query_username_result = $query_autologin->fetch(PDO::FETCH_ASSOC);
            $username_name = $query_username_result["Full Name"];
            $username = $query_username_result["Username"];
            $hasPicture = $query_username_result["ProfilePicture"];
            loggedin($username, $username_name, $hasPicture);
        } else {
            normalLogin();
        }
    } else {
        normalLogin();
    }
    
    function normalLogin() {
        global $conn, $cookie_name;
        if( isset($_POST["uname"]) ) {
            $username = $_POST["uname"];
            $password = $_POST["psw"];
// Check for invalid characters, only the characters from [ ] are allowed
            if (preg_match("/[^A-Za-z0-9@._]/", $username)) {
                $login_action = "Invalid characters in login name! Allowed characters: A-Z a-z 0-9 @ . _ ";
                loginMenuShow($login_action, $username);
            } else {
// Query database if username found
                $query_username = $conn->query("SELECT * FROM Users WHERE Username LIKE BINARY '$username'");
                $found_username = $query_username->rowCount();
                if ($found_username > 0) {
                    //echo "<script>console.log('$username');</script>;";
                    $query_username_result = $query_username->fetch(PDO::FETCH_ASSOC);
                    if ($query_username_result["Password"] == $password) {
                        $username_name = $query_username_result["Full Name"];
                        $hasPicture = $query_username_result["ProfilePicture"];
                        $cookie_value = uniqid() . (new \DateTime())->format('Y-m-d H:i:s');
	                    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
                        $query_autologin = $conn->query("UPDATE `Users` SET `AutologinCookie` = '$cookie_value' WHERE `Users`.`Username` = '$username'");
                        loggedin($username, $username_name, $hasPicture);
                    } else {
                        $login_action = "Incorrect Password!";
                        loginMenuShow($login_action, $username);
                    }
                } else {
                    $login_action = "Username not found!";
                    loginMenuShow($login_action, $username);
                }
            }
        } else {
            $login_action = "normal";
            $username = "";
	        loginMenuShow($login_action, $username);
        }
    }
    
    function loginMenuShow($login_action, $username) {
        if ($login_action != "normal") {
            echo '<form id="login-menu" class="login-menu" action="" method="post">';
        } else {
            echo '<form id="login-menu" class="login-menu animate" action="" method="post">';
        }
?>
            <div class="login-img-container">
                <img src="/images/login-logo.jpg" alt="Login-Logo" class="login-img">
    	    </div>
            <div class="login-inputfields-container">
			    <label for="uname"><b>Username</b></label>
      		    <input type="text" placeholder="Enter Username" name="uname" id="uname" required>
      		    <label for="psw"><b>Password</b></label>
      		    <input type="password" placeholder="Enter Password" name="psw" required>
			    <button type="submit" name="btnSubmit" class="buttons" onclick="submitButtonClick(event)">Login</button>
			    <span class="highlightYellow" id="login-span">Insert Login Credentials!</span>
			</div>
    	</form>
<?php
        if ($login_action != "normal") {
            echo "<script>
                document.getElementById('login-span').innerHTML = '$login_action';
                document.getElementById('login-span').style.color = 'red';
                document.getElementById('uname').value = '$username';
            </script>";
        }
        echo '<script>
            function loginMenuShow() {
                var modal = document.getElementById("modal");
                var login_menu = document.getElementById("login-menu");
    	        login_menu.style.display = "block";
	        }
	        setTimeout(loginMenuShow, 850);
	   </script>';
    }
?>
<script>
//main-----------------------------------------------------------------------------------------
	var modal = document.getElementById("modal");
    var loader = document.getElementById("loader");
    var login_menu = document.getElementById("login-menu");
    var desksTotal = 56; //total number of desks
    
	function loaderHide() {
	    var profile_window = document.getElementById("profile-window");
	    var profile_window_positio;
	    if (profile_window) {
	        profile_window_position = profile_window.getBoundingClientRect().right;
	    } else {
	        profile_window_position = 0;
	    }
        if (profile_window_position > 0) {
            modal.style.visibility = "visible";
            modal.style.opacity = "1";
        } else {
            modal.style.visibility = "hidden";
    	    modal.style.opacity = "0";
    	}
    	loader.style.visibility = "hidden";
		loader.style.opacity = "0";
	}
	
	function loaderShow() {
	    modal.style.visibility = "visible";
    	modal.style.opacity = "1";
        loader.style.visibility = "visible";
		loader.style.opacity = "1";
	}

// When the user clicks anywhere outside of the modal, close it
    modal.addEventListener('click', function(event) {
        if(login_menu == null) {
            modal.style.visibility = "hidden";
            modal.style.opacity = "0";
            CloseSideBar();
            ProfileWindow_Close();
            if (getComputedStyle(booking_menu).display == "block") {
                CloseBookingMenu(event);
            }
        }
    });
    
// Login form Check for "'" illegal character in Username field
    var uname = document.getElementById("uname");
    function submitButtonClick(event) {
		var illegalchars = /[!#$%^&*()+\-=\[\]{};`':"\\|,<>\/?]+/;
		if (illegalchars.test(uname.value) == true) {
		    event.preventDefault();
		    var login_span = document.getElementById('login-span');
		    login_span.innerHTML = "Invalid characters in login name! Allowed characters: A-Z a-z 0-9 @ . _ ";
		    // reset css animation with the next 3 lines, by removing and readding the element class
		    login_span.classList.remove("highlightYellow");
		    login_span.offsetWidth;
		    login_span.classList.add("highlightYellow");
		} else {
		    document.getElementById('login-span').innerHTML = "Insert Login Credentials!";
		}
    } 

// Set Datepicker Date
    var datepicker = document.getElementById('datepicker');
    if(datepicker != null) {
        var today = new Date();
        var today_dd = today.getDate();
        var today_mm = today.getMonth()+1; //January is 0 so need to add 1 to make it 1!
        var today_yyyy = today.getFullYear();
        if (today_dd < 10) {
            today_dd = '0' + today_dd
        }
        if (today_mm < 10) {
            today_mm = '0' + today_mm
        }
        today = today_yyyy + '-' + today_mm + '-' + today_dd;
        datepicker.setAttribute('value', today);
    }

// Change Datepicker Date
    if(datepicker != null) {
        datepicker.addEventListener('change', function(event) {
            if(view_button.className == "button-view-container") {
                getDeskImages();
            } else {
                colorDesks();
            }
        });
    }
    
// Create desk buttons and images
    floor_container = document.getElementById('floor-container');
    function createButtons() {
        if (floor_container != null) {
            for (let i = 1; i <= desksTotal; i++) {
                let btn = document.createElement('button');
                btn.innerHTML = i;
                btn.className += 'button-desk button-desk' + i;
                btn.id = 'button' + i;
                floor_container.appendChild(btn);
                let btn_img = document.createElement('img');
                btn_img.className += 'floor-booker-img button-desk' + i;
                btn_img.id = 'image' + i;
                floor_container.appendChild(btn_img);
                btn_img.style.visibility = "hidden";
            }
        }
    }
    createButtons();

// Color desks
    function colorDesks() {
        loaderShow();
        if (floor_container != null) {
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var desksStateArray = this.responseText;
                    desksStateArray = desksStateArray.split(";");
                    for (let i = 1; i <= desksTotal; i++) {
                        document.getElementById('button'+ i).classList.remove('button-desk' + i);
		                document.getElementById('button'+ i).offsetWidth;
		                document.getElementById('button'+ i).classList.add('button-desk' + i);
		                document.getElementById('button'+ i).style.backgroundColor = 'green';
		                document.getElementById('button'+ i).innerHTML=i;
                    }
                    for (let i = 0; i < desksStateArray.length; i++) {
                        if (desksStateArray[i]) {
                            var dbBooker = desksStateArray[i].split(" - ")[0];
                            var dbDesk = desksStateArray[i].split(" - ")[1];
                            var dbUsername = desksStateArray[i].split(" - ")[2];
                            //console.log(dbBooker, dbDesk);
                            if ( dbBooker == document.getElementById('SideBarUserName').innerHTML ) {
                                document.getElementById('button'+ dbDesk).style.backgroundColor = 'pink';
                            } else {
                                document.getElementById('button'+ dbDesk).style.backgroundColor = 'red';
                            }
                        }
                    }
                }
            };
            xmlhttp.open("GET", "desksState.php?datePicker=" + datepicker.value, true);
            xmlhttp.send();
        }
        setTimeout(loaderHide, 800);
    }

// Get Desk Images
    function getDeskImages() {
        loaderShow();
        var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var desksStateArray = this.responseText;
                    desksStateArray = desksStateArray.split(";");
                    for (let i = 1; i <= desksTotal; i++) {
                        document.getElementById('image'+ i).classList.remove('button-desk' + i);
		                document.getElementById('image'+ i).offsetWidth;
		                document.getElementById('image'+ i).classList.add('button-desk' + i);
		                document.getElementById('button'+ i).classList.remove('button-desk' + i);
		                document.getElementById('button'+ i).offsetWidth;
		                document.getElementById('button'+ i).classList.add('button-desk' + i);
		                document.getElementById('button'+ i).style.background="transparent";
		                document.getElementById('button'+ i).innerHTML="";
		                document.getElementById('image'+ i).style.visibility = "hidden";
		                document.getElementById('image'+ i).src = "";
                    }
                    for (let i = 0; i < desksStateArray.length; i++) {
                        if (desksStateArray[i]) {
                            var dbBooker = desksStateArray[i].split(" - ")[0];
                            var dbDesk = desksStateArray[i].split(" - ")[1];
                            var dbUsername = desksStateArray[i].split(" - ")[2];
                            var dbProfilePicture = desksStateArray[i].split(" - ")[3];
                            //console.log(dbDesk, dbUsername, dbProfilePicture);
                            if (dbProfilePicture == "custom") {
                                document.getElementById('image'+ dbDesk).src = '/images/Users/' + dbUsername + "?random=" + new Date().getTime();
                                document.getElementById('image'+ dbDesk).style.visibility = "visible";
                            } else if (dbProfilePicture == "female") {
                                document.getElementById('image'+ dbDesk).src = '/images/booker_F.png';
                                document.getElementById('image'+ dbDesk).style.visibility = "visible";
                            } else if (dbProfilePicture == "male") {
                                document.getElementById('image'+ dbDesk).src = '/images/booker_M.png';
                                document.getElementById('image'+ dbDesk).style.visibility = "visible";
                            } else {
                                document.getElementById('image'+ dbDesk).style.visibility = "hidden";
                                array_username = dbBooker.split(" ");
                                var username_initials="";
                                for (let j = 0; j < array_username.length; j++) {
                                    username_initials=username_initials + array_username[j].substring(0,1);
                                }
                                document.getElementById('button'+ dbDesk).innerHTML=username_initials;
                                if ( dbBooker == document.getElementById('SideBarUserName').innerHTML ) {
                                    document.getElementById('button'+ dbDesk).style.backgroundColor = 'pink';
                                } else {
                                    document.getElementById('button'+ dbDesk).style.backgroundColor = 'red';
                                }
                            }
                        }
                    }
                }
            };
            xmlhttp.open("GET", "desksState.php?datePicker=" + datepicker.value, true);
            xmlhttp.send();
        setTimeout(loaderHide, 800);
    }

// Sidebar
    var sidebar = document.getElementById("sidebar-container");
    var sidebar_burger_button = document.getElementById("burger-menu-button");
    var hasPicture = document.getElementById('sidebar-HasPicture-Hidden');
    var username_picture = document.getElementById("sidebar-image-profile");
    var profile_username_picture = document.getElementById("profile-window-img3");
    var username = document.getElementById("sidebar-UserName-Hidden");
    if (sidebar) {
        profile_username_picture.src = '/images/Users/' + username.innerHTML  + "?random=" + new Date().getTime();
        if (hasPicture.innerHTML == "custom") {
            username_picture.src = '/images/Users/' + username.innerHTML  + "?random=" + new Date().getTime();
            document.getElementById('profile-window-image3').checked = true;
        } else if (hasPicture.innerHTML == "female") {
            username_picture.src = '/images/booker_F.png';
            document.getElementById('profile-window-image1').checked = true;
        } else if (hasPicture.innerHTML == "male") {
            username_picture.src = '/images/booker_M.png';
            document.getElementById('profile-window-image2').checked = true;
        } else {
            document.getElementById('profile-window-noimage').checked = true;
        }
    }

    function OpenSideBar() {
        modal.style.visibility = "visible";
        modal.style.opacity = "1";
        sidebar.style.transform = "translateX(0)";
    }

    function CloseSideBar() {
        if(sidebar != null) {
            sidebar.style.transform = "translateX(-100%)";
        }
    }
    
    var view_button = document.getElementById("view-button");
    function ChangeDesksView() {
        if(view_button.className == "button-view-container") {
            view_button.classList.replace("button-view-container", "booker-view-container");
            for (let i = 1; i <= desksTotal; i++) {
                document.getElementById('button'+ i).classList.remove('button-desk' + i);
		        document.getElementById('button'+ i).offsetWidth;
		        document.getElementById('button'+ i).classList.add('button-desk' + i);
		        document.getElementById('button'+ i).style.visibility = "visible";
                document.getElementById('image'+ i).style.visibility = "hidden";
            }
            colorDesks();
        } else {
            view_button.classList.replace("booker-view-container", "button-view-container");
            getDeskImages();
        }
    }

// Booking-menu
    var booking_menu = document.getElementById("booking-menu");
    var button_booking_close = document.getElementById("button-booking-close");
    var bookingMenuStateMessage = document.getElementById("booking-menu-bookstate-message");
    var button_booking_book = document.getElementById("button-booking-book");

    document.querySelectorAll('.button-desk, .floor-booker-img').forEach(item => {
        item.addEventListener('click', event => {
            if (getComputedStyle(booking_menu).display == "none") {
                var DeskNumber;
                bookingMenuStateMessage.innerHTML = "";
                if (event.target.id.indexOf("button") > -1) {
                    DeskNumber = event.target.id.substring(6);
                } else {
                    DeskNumber = event.target.id.substring(5);
                }
                OpenBookingMenu(DeskNumber);
            }
        })
    })
    
    if (button_booking_close != null) {
        button_booking_close.addEventListener('click', function(event) {
            CloseBookingMenu(event);
        });
    }
	
	var bookingMenuLabel = document.getElementById("booking-menu-label-desk-number");
	var bookingMenuBooker = document.getElementById("booking-menu-label-booker");
	var bookingMenuUsername = document.getElementById("booking-menu-label-username-hidden");
    function OpenBookingMenu(DeskNumber) {
        bookingMenuLabel.innerHTML = "Desk Number " + DeskNumber;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var Data = JSON.parse(this.responseText);
                bookingMenuBooker.innerHTML = Data.db_booker;
                bookingMenuUsername.innerHTML = Data.db_username;
                if (Data.db_booker == "Free") {
                    button_booking_book.innerText = "Book";
                    document.getElementById('booking-circle').innerHTML = "Free";
                    document.getElementById('booking-img').style.display = "none";
                    document.getElementById('booking-circle').style.display = "block";
                    bookingMenuBooker.style.display = "none";
                    document.getElementById('booking-circle').style.backgroundColor = 'green';
                } else {
                    button_booking_book.innerText = "UnBook";
                    bookingMenuBooker.style.display = "block";
                    if (Data.db_ProfilePicture == "custom") {
                        document.getElementById('booking-img').src='/images/Users/' + bookingMenuUsername.innerHTML  + "?random=" + new Date().getTime();
                        document.getElementById('booking-circle').style.display = "none";
                        document.getElementById('booking-img').style.display = "inline-block";
                    } else if (Data.db_ProfilePicture == "female") {
                        document.getElementById('booking-img').src = '/images/booker_F.png';
                        document.getElementById('booking-circle').style.display = "none";
                        document.getElementById('booking-img').style.display = "inline-block";
                    } else if (Data.db_ProfilePicture == "male") {
                        document.getElementById('booking-img').src = '/images/booker_M.png';
                        document.getElementById('booking-circle').style.display = "none";
                        document.getElementById('booking-img').style.display = "inline-block";
                    } else {
                        document.getElementById('booking-img').style.display = "none";
                        if ( bookingMenuUsername.innerHTML == document.getElementById('sidebar-UserName-Hidden').innerHTML ) {
                            document.getElementById('booking-circle').style.backgroundColor = 'pink';
                        } else {
                            document.getElementById('booking-circle').style.backgroundColor = 'red';
                        }
                        array_username = Data.db_booker.split(" ");
                        var username_initials="";
                        for (let j = 0; j < array_username.length; j++) {
                            username_initials = username_initials + array_username[j].substring(0,1);
                        }
                        document.getElementById('booking-circle').innerHTML = username_initials;
                        document.getElementById('booking-circle').style.display = "block";
                    }
                }
            }
        };
        xmlhttp.open("GET", "deskState.php?deskNr=" + DeskNumber + "&bookDate=" + datepicker.value, true);
        xmlhttp.send();
        modal.style.visibility = "visible";
        modal.style.opacity = "1";
        booking_menu.style.display = "block";
        
    }

    function BookDesk(event) {
        event.preventDefault();
        var DeskNumber = bookingMenuLabel.innerHTML.substring(12);
        var booker = document.getElementById('SideBarUserName').innerHTML;
        var username = document.getElementById('sidebar-UserName-Hidden').innerHTML;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //console.log(this.responseText);
                bookstate = this.responseText;
                if ( bookstate == "Desk Booked!" || bookstate == "Desk UnBooked!") {
                    bookingMenuStateMessage.innerHTML = bookstate;
                    //location.href = 'https://deskbooking.net/';
                    if(view_button.className == "button-view-container") {
                        getDeskImages();
                    } else {
                        colorDesks();
                    }
                    booking_menu.style.display = "none";
                } else {
                    bookingMenuStateMessage.innerHTML = bookstate;
                }
            }
        };
        xmlhttp.open("GET", "bookDesk.php?booker=" + booker + "&username=" + username + "&deskNr=" + DeskNumber + "&bookDate=" + datepicker.value + "&hasPicture=" + hasPicture.innerHTML, true);
        xmlhttp.send();
    }
    
    function CloseBookingMenu(event) {
        event.preventDefault();
        modal.style.visibility = "hidden";
        modal.style.opacity = "0";
        booking_menu.style.display = "none";
    }
    
// Sign-out user
    var sign_out = document.getElementById("sign-out");
    if (sign_out != null) {
        sign_out.addEventListener('click', function(event) {
            CloseSideBar();
            document.cookie = "autologin=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
            location.href = 'https://deskbooking.net/';
        });
    }
    
// Profile window
    var profile_window = document.getElementById("profile-window");
    var sidebar_user_full_name = document.getElementById("SideBarUserName");
    var upload_image = document.getElementById("upload-image");
    var ProfileWindowUserName = document.getElementById("ProfileWindowUserName");
    var ProfileWindowFullName = document.getElementById("ProfileWindowFullName");
    var file_upload = document.getElementById('file-upload');
    if (profile_window != null) {
        ProfileWindowUserName.value = username.innerHTML;
        ProfileWindowFullName.value = sidebar_user_full_name.innerHTML;
        file_upload.addEventListener('change', SaveImage, false);
    }

    function ProfileWindow_Open() {
        sidebar.style.transform = "translateX(-100%)";
        profile_window.style.transform = "translateX(0%)";
    }
    
    function ProfileWindow_Close() {
        profile_window.style.transform = "translateX(-100%)";
        modal.style.visibility = "hidden";
        modal.style.opacity = "0";
        document.getElementById('profile-window-span').innerHTML = "";
    }
    
     function updateDB_ProfilePicture(ProfilePictureStatus) {
        loaderShow();
        switch (ProfilePictureStatus) { //switch is very stupid and requires break, else it cotinues with all cases.. dahh!
            case "none": {
                document.getElementById('profile-window-noimage').checked = true;
                src = "/images/booker_view_button.png";
                break;
            }
            case "female": {
                document.getElementById('profile-window-image1').checked = true;
                src = "/images/booker_F.png";
                break;
            }
            case "male": {
                document.getElementById('profile-window-image2').checked = true;
                src = "/images/booker_M.png";
                break;
            }
            default: {
                document.getElementById('profile-window-image3').checked = true;
                src = "/images/Users/" + username.innerHTML + "?random=" + new Date().getTime();
            }
        }
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                username_picture.src = src;
                hasPicture.innerHTML = ProfilePictureStatus;
            }
        };
        xmlhttp.open('POST', 'updateDB_ProfilePicture.php?ProfileWindowUserName=' + ProfileWindowUserName.value + '&ProfilePictureStatus=' + ProfilePictureStatus, true);
        xmlhttp.send();
        
        setTimeout(
		    function() {
                loader.style.visibility = "hidden";
		        loader.style.opacity = "0";
		        if(view_button.className == "button-view-container") {
                    getDeskImages();
                }
        	}
        , 1200);
    }
    
    function SaveImage() {
        loaderShow();
        var file = file_upload.files[0];
        if (file.type.indexOf("image") == -1) {
            document.getElementById('profile-window-span').innerHTML = "File type not allowed!";
            document.getElementById('profile-window-span').style.color = 'red';
            document.getElementById('profile-window-span').classList.remove("highlightYellow");
		    document.getElementById('profile-window-span').offsetWidth;
		    document.getElementById('profile-window-span').classList.add("highlightYellow");
            loader.style.visibility = "hidden";
            loader.style.opacity = "0";
        } else {
            document.getElementById('profile-window-span').innerHTML = "";
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function(event) {
                const imgElement = document.createElement("img");
                imgElement.src = event.target.result;
                imgElement.onload = function (e) {
                    const canvas = document.createElement("canvas");
                    const max_width = 300;
                    const scaleSize = max_width / e.target.width;
                    canvas.width = max_width;
                    canvas.height = e.target.height * scaleSize;
                    const ctx = canvas.getContext("2d");
                    ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
                    const srcEncoded = ctx.canvas.toDataURL(e.target);
                    //document.getElementById("myCanvas").src = srcEncoded;
                    canvas.toBlob(
                        function (blob) {
                            var fd = new FormData();
                            fd.append("file", blob);
                            var xhr = new XMLHttpRequest();
                            xhr.open('POST', 'upload.php?ProfileWindowUserName=' + ProfileWindowUserName.value, true);
                            xhr.send(fd);

                            xhr.onreadystatechange = function() {
    			                if(xhr.readyState == 4 && xhr.status == 200) {
				                    document.getElementById('profile-window-span').innerHTML = xhr.responseText;
                                    document.getElementById('profile-window-span').style.color = 'black';
                                    document.getElementById('profile-window-span').classList.remove("highlightYellow");
		                            document.getElementById('profile-window-span').offsetWidth;
		                            document.getElementById('profile-window-span').classList.add("highlightYellow");
			                    }
		                    };
		        
		                    setTimeout(
    		                    function() {
                                    profile_username_picture.src = "/images/Users/" + username.innerHTML + "?random=" + new Date().getTime();
                                    username_picture.src = '/images/Users/' + username.innerHTML + "?random=" + new Date().getTime();
                                    document.getElementById('sidebar-HasPicture-Hidden').innerHTML = 'custom';
                                    document.getElementById('profile-window-image3').checked = true;
                                    loader.style.visibility = "hidden";
		                            loader.style.opacity = "0";
        	                    }
                            , 1500);
                        }
                    );
                }
            }
        }
    }
    
    function FileUploadWindow() {
        file_upload.click();
    }
    

    
    
    
// Start running code and functions
    colorDesks();
    //document.cookie = "selectedDate=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    
//   https://www.w3schools.com/howto/tryit.asp?filename=tryhow_css_login_form_modal
//   https://www.w3schools.com/php/phptryit.asp?filename=tryphp_numbers_integer
// https://www.youtube.com/watch?v=kffivnAYUAY
	
</script>
</body>
</html>