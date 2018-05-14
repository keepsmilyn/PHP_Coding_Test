<html>
<head>
<title>PHP Coding Test</title>
</head>
<body>

<h1>Scenario:</h1>
<p>Online visibility is a metric we have devised to allow us to graphically plot progression in search
rankings. It is known that most searchers will only go up to 30 results deep for their search term
before they try another search. This means we can say that a ranking of 30th is worth 1 point
while a ranking of 1st is worth 30 points.</p>

<p>We also know that in the UK, Google provides 85% of the available traffic, Yahoo provides 10%
and Bing provides 5%. This means that a 1st in Google is worth 17 times more than a 1st in
Bing etc.</p>

<p>From the rankings data we can calculate a visibility score for a domain and a search term. The
visibility score is a percentage of the maximum possible score, arrived at by the following
calculation:</p>

<p>((31 - gR) * 17 + (31 - yR) * 2 + (31 - bR)) / 600 * 100</p>

<p>Where gR = google ranking, yR = yahoo ranking and bR = bing ranking. Rankings must be in
the range (1-30).</p>

<p>600 is the maximum possible score attainable (30 * 17 + 30 * 2 + 30 * 1 = 600).</p>

<p>We have a table of rankings data showing how a particular domain ranks for a set of search
terms in each of the 3 main engines:</p>

<a href="table1.php">TABLE 1 (click to view).</a>

<p>A value of 0 in the ranking table means the domain ranked outside the top 30.</p>


<h2>Task:</h2>
<p>Write a script to populate the table of visibility scores (table 2) from rankings data in table 1.
The script should be able to handle multiple dates and multiple search terms. It is not safe to
assume that a record will be present for all three engines for every date and term so the script
should handle this by assuming a ranking of zero. <span style="color: red;">Records with a ranking of zero should be
excluded from the calculation.</span></p>

<p>The script should execute as quickly as possible in order to process potentially large amounts of
data in a short time.</p>

<p>Use any libraries and functions you are familiar with. Don't worry about setting up a connection
to the database, just assume one is present</p>

<p><b><a href="run-seo-script.php?runseo=1">Run SEO Script &raquo;</a></b></p>
</body>
</html>