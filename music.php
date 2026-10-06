<!DOCTYPE html >
<html >
	<head>
		<title>
			<?php
				echo "Hello World";
			?>
		</title>

		<link href="viewer.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="header">
			<h1>3052 Music Playlist Viewer</h1>
			<h2>Search Through Your Playlists and Music</h2>
		</div>

		<div id="listarea">
			<ul id="musiclist">
				<?php	
					foreach (glob("songs/*.mp3") as $filename) {
						echo "<li class=mp3item>";
						echo "<a href=".basename($filename).">".basename($filename)."</a>";
						echo "</li>";
					}
				?>
			
				<?php
				foreach (glob("songs/mypicks.txt") as $pick) {
					echo "<li class=playlistitem>";
					echo "<a href=music.php?playlist=".basename($pick).">".basename($pick)."</a>";
					echo "</li>";
				}
				?>
				<?php
				foreach (glob("songs/playlist.txt") as $picks) {
					echo "<li class=playlistitem>";
					echo "<a href=music.php?playlist=".basename($picks).">".basename($picks)."</a>";
					echo "</li>";
				}
				?>
			</ul>
		</div>
	</body>
</html>
