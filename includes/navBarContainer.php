<div id="navBarContainer">
	<nav class="navBar">

		<span  role="link" tabindex="0" onclick="openPage('index.php')" class="logo" >
			<img src="assets/images/logos/sonikz-bold.png">
		</span>


		<div class="group">

			<div class="navItem">
				<span role="link" tabindex="0" onclick='openPage("search.php")' class="navItemLink">Search
					<img src="assets/images/icons/search.png" class="icon" alt="Search">
				</span>
			</div>

		</div>

		<div class="group">
			<div class="navItem">
				<span  role="link" tabindex="0" onclick="openPage('browse.php')" class="navItemLink link">Browse</span>
			</div>
			<div class="navItem">
				<span  role="link" tabindex="0" onclick="openPage('all-artists.php')" class="navItemLink link">Artists</span>
			</div>

			<div class="navItem">
				<div role="link" tabindex="0" onclick="showLibraryMenu(this)"  class="navItemLink link">Library <i class="fa fa-caret-down m-left-5" style="font-size:16px;" id="library-menu-icon"></i></div>
				<div class="" id="library-menu" data-collapsed="false" style="display:none;">
					<div class="bordertop" style="margin-top:10px;"></div>
				     <div class="m-left-10">
							 <div class="navItem push-top-5">
							 		<span role="link" tabindex="0" onclick="openPage('yourPlaylist.php')"  class="navItemLink link">Playlists</span>
							 </div>
							 <div class="navItem">
								 <span role="link" tabindex="0" onclick="openPage('settings.php')"  class="navItemLink link">Artists</span>
							 </div>
							 <div class="navItem">
								 <span role="link" tabindex="0" onclick="openPage('settings.php')"  class="navItemLink link">Albums</span>
							 </div>
							 <div class="navItem">
								 <span role="link" tabindex="0" onclick="openPage('settings.php')"  class="navItemLink link">Songs</span>
							 </div>
						 </div>
					</div>
				</div>

			<div class="navItem">
				<span role="link" tabindex="0" onclick="openPage('settings.php')"  class="navItemLink link"><i role="link" class="fa fa-gear navItemLink link"></i> <?php echo $userLoggedIn->getFirstAndLastName(); ?></span>
			</div>
		</div>




	</nav>
</div>
