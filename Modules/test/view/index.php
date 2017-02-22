<video autoplay></video>

<script>
	navigator.getUserMedia = navigator.getUserMedia || navigator.mozGetUserMedia || navigator.webkitGetUserMedia;
	navigator.getUserMedia({ audio: true, video: true }, gotStream, streamError);

	function gotStream(stream) {
		document.querySelector('video').src = URL.createObjectURL(stream);
	}

	function streamError(error) {
		console.log(error);
	}
</script>

<?php

/*function inverse($x) {
	if (!$x) {
		throw new Exception('Деление на ноль.', 1);
	}
	return 1/$x;
}

try {
	echo inverse(5) . "\n";
	echo inverse(0) . "\n";
} catch (Exception $e) {
	echo 'Выброшено исключение: ',  $e->getMessage(), "\n";
}*/

?>