<nav class="navbar navbar-default navbar-light bg-faded fixed-top" id="navbar" role="navigation">
            <table id="nav-table">
                <thead>
                    <tr>
                        <td id="nav-table-item1">
                            <button type="button" id = "toggle-button" onclick="toggleNav()" class="navbar-toggler btn btn-link stage-toggle">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </td>
                        <td id="nav-table-item2">
                            <div>
                                <a class="navbar-brand" href="<?php echo base_url('index.php/home/homePage');?>">
                                    <img src="http://nijojob.heliohost.org/Common/css/images/icon.jpg" width="38" height="38" class="d-inline-block align-top">
                                    MyApp
                                </a>
                            </div>
                        </td>
                        <td id="nav-table-item3">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><div id =  "user"><?php echo $user;?></div></a>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                        <hr>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/loadChange');?>">Change Password</a>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/loadDelete');?>">Delete Account</a>
                                        <hr>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/askHelp');?>">Help & Support</a>
                                        <a class="dropdown-item" id="dropdown-text" href="<?php echo base_url('index.php/home/logOut');?>">Log Out</a>
                                    </div>
                                </li>
                            </ul>                                        
                        </td>
                    </tr>
                </thead>
            </table>
        </nav>