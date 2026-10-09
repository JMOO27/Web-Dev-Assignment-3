<!DOCTYPE html >
<html >
	<head>
		<title>
			<?php
				echo "3052 Music Playlist Viewer"
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
				if (isset($_GET["playlist"])) {
					$playlist_id = $_GET["playlist"];
					$playlist_path = "songs/{$playlist_id}";

					$file = fopen($playlist_path, "r");

					if ($file) {
						while (($line = fgets($file)) !== false) {
							$name = trim($line);
							echo "<li class=mp3item>";
							echo "<a href=\"songs/{$name}\">{$name}</a>";
							echo "</li>";
						}
						fclose($file);
					}
				}
				elseif (isset($_GET["shuffle"])) {
					$songList = [];
					foreach (glob("songs/*.mp3") as $song) {
						$songList[] = $song;
					}
					shuffle($songList);

					foreach($songList as $song) {
						$name = basename($song);
						$size = filesize($song);

						echo "<li class=mp3item>";
						echo "<a href=\"songs/{$name}\">{$name}</a>";
						echo "</li>";
					}
					
				}
				else {
					foreach (glob("songs/*.mp3") as $filename) {
						$name = basename($filename);
						$size = filesize($filename);

						if ($size <= 1048575 || $size == 1024) {
							$size *= 1024; # mult and assign operator!
							$size = round($size, 2);
							$size_str = "{$size} kb";
							
						}
						else if ($size > 1048575) {
							$size /= 1048575;
							$size = round($size, 2);
							$size_str = "{$size} mb";
						}

						echo "<li class=mp3item>";
						echo "<a href=\"songs/{$name}\">{$name} ({$size_str})</a>";
						echo "</li>";
						}

						foreach (glob("songs/mypicks.txt") as $pick) {
							$name = basename($pick);	
							echo "<li class=playlistitem>";
							echo "<a href=\"music.php?playlist={$name}\">{$name}</a>";
							echo "</li>";
						}
						foreach (glob("songs/playlist.txt") as $picks) {
						$name = basename($picks);
							echo "<li class=playlistitem>";
							echo "<a href=\"music.php?playlist={$name}\">{$name}</a>";
							echo "</li>";
						}
					}
				?>
			</ul>
		</div>
	</body>
</html>
