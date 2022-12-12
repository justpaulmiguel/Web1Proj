<?php
$title = 'Past Records';
require("./partials/head.php");

// functions on record querying
require("./recordQueries.php");

// GET the filter properties
$filterType = isset($_GET['filter']) ? $_GET['filter'] : "date";
$sortType = isset($_GET['sort']) ? $_GET['sort'] : 0;
$specificFilter;
$filterName = '';
$searchTitle = "Search Result for ";

if ($filterType == 'date') {
    $dateToday = date('Y-m-d');
    $specificFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : $dateToday;
    $filterName = 'dateFilter';
    $searchTitle = 'Search Date for ' . $dateToday;
} else if ($filterType == 'state') {
    $specificFilter = $_GET['stateFilters'];
    $filterName = 'stateFilters';
    $searchTitle .= "'$state' State";
} else if ($filterType == 'email') {
    $specificFilter = $_GET['emailFilter'];
    $filterName = 'emailFilter';
    $searchTitle .= "'$specificFilter' Email";
} else if ($filterType == 'service') {
    $specificFilter = $_GET['serviceFilters'];
    $filterName = 'serviceFilters';
    $searchTitle .= "'$specificFilter' Service";
}

// get number of pages
$countQuery = getCountQuery($filterType, $specificFilter);
$count = getCount($countQuery);
// number of rows per page
$limit = 10;
$pages = ceil($count / $limit);

// current page
$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
    'options' => array(
        'default'   => 1,
        'min_range' => 1,
    ),
)));

$offset = ($page - 1)  * $limit;

// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $count);


$linkName = '?' . 'filter=' . $filterType . '&sort=' . $sortType . '&' . $filterName;


$query = getQuery($filterType, $limit, $offset, $specificFilter, $sortType);

$records = getRecords($query);


?>



<main>
    <h1>Past Records</h1>
    <p>Search our records.</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="search-record-form">

        <select name="filter" id="filter-select" required>
            <option value="" disabled>Select a Filter</option>
            <option value="date" selected>From Date</option>
            <option value="state">Appointment State</option>
            <option value="email">Email</option>
            <option value="service">Service</option>

        </select>

        <select name="sort" id="sort" required>
            <option value="" disabled>Sort by</option>
            <option value="0" selected>Newest</option>
            <option value="1">Oldest</option>

        </select>



        <input type="submit" id="search-btn" value="Search">
    </form>
    <?php if (!empty($records)) : ?>
        <h2> <?= $searchTitle ?></h2>
        <table border="2" cellpadding="10" cellspacing="1">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>State</th>
                <th>Branch</th>
                <th colspan="2">Name</th>
                <th>Service</th>
                <th>Account ID</th>
            </tr>
            <?php foreach ($records as $record) : ?>


                <tr align="center" class="patient-req-row">
                    <td><?= $record['date'] ?></td>
                    <td><?= $record['time'] ?></td>
                    <td><?= $record['state'] ?></td>
                    <td><?= $record['branch'] ?></td>
                    <td><?= $record['lname'] ?></td>
                    <td><?= $record['fname'] ?></td>
                    <td><?= $record['service'] ?></td>
                    <td><?= $record['account_ID'] ?></td>
                </tr>


            <?php endforeach; ?>
        </table>

        <?php if ($page > 1) : /**Previous Page Arrow*/ ?>
            <a href="<?= $linkName . '&page=1' ?>" title="First page">&laquo;</a>
            <a href="<?= $linkName . '&page=' . ($page - 1) ?>" title="Previous page">&lsaquo;</a>
        <?php else : ?>
            <span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>
        <?php endif ?>

        <?php if ($page < $pages) : /**Next Page Arrow */  ?>
            <a href="<?= $linkName . '&page=' . ($page + 1) ?>" title="Next page">&rsaquo;</a>
            <a href="<?= $linkName . '&page=' . $pages ?>" title="Last page">&raquo;</a>
        <?php else : ?>
            <span class="disabled">&rsaquo;</span>
            <span class="disabled">&raquo;</span>
        <?php endif ?>

        <div id="paging">
            <p> <?=
                /**Page Information*/
                ' Page ' . $page . ' of ' . $pages . ' page(s). displaying ' . $start . '-' . $end . ' of ' . $total . ' results ' . $nextlink

                ?>
            </p>
        </div>


    <?php else : ?>
        <h2>No Records found!</h2>
    <?php endif ?>
</main>


<?php require("partials/footer.php") ?>