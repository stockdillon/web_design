<?php
namespace Noir;

/**
 * View class for the movie info page
 */
class InfoView extends View {

	/**
	 * DeleteView constructor.
	 * @param Site $site Site object
	 * @param $user User
	 * @param array $get $_GET
	 * @param array $session $_SESSION
	 */
	public function __construct(Site $site, $user, array $get) {
		parent::__construct($site);
		$this->user = $user;
		$this->get = $get;
		$this->setTitle("Ajax Noir Movie");
	}

	/**
	 * Present the page body
	 * @return string HTML for the page body
	 */
	public function present() {
		$title = '';
		$year = '';
		$rating = null;

		$html = <<<HTML
	<form method="post" action="post/home.php">
    <p class="buttons">
        <input type="submit" name="home" value="Home">
        <input type="submit" name="logout" value="Logout">
    </p>
    </form>
HTML;

		// Editing an existing movie
		$movies = new Movies($this->site);
		$movie = isset($this->get['i']) ?
			$movies->get($this->user, $this->get['i']) : null;
        if($movie !== null) {
            $title = addslashes($movie->getTitle());
            $year = addslashes($movie->getYear());
            $content = <<<CONTENT
CONTENT;




            /*
             * This is an example of a simple message
             */
/*
            $content = <<<CONTENT
<script>
$(document).ready(function() {
	new MovieInfo(".paper", "$title", "$year");
});
</script>
CONTENT;
*/


			/*
			 * This is an example of three tabs.
			 * I have added class show to one to show it, but
			 * you should implement the show yourself in
			 * JavaScript
			 */


			$content = <<<CONTENT
<ul>

<li><a href=""><img src="images/info.png"></a>
<div class="show"><p>Loading...</p>
</div>
</li>

<li><a href=""><img src="images/plot.png"></a>
<div>
</div>
</li>

<li><a href=""><img src="images/poster.png"></a>
<div>
<p class="poster"><img src="images/maltese.jpg">
</p></div>
</li>

</ul>
CONTENT;


		} else {
			$content = "<p>No movie selected.</p>";
		}

        $content .= <<<HTML
<script>
$(document).ready(function() {
	new MovieInfo(".paper", "$title", "$year");
});
</script>
HTML;


		$html .= <<<HTML
<div class="paper-wrapper">
<div class="paper">
$content
</div>
</div>
<p class="attrib"><img src="images/moviedb.png"></p>
HTML;
		return $html;
	}

	private $user;
	private $get;
}
