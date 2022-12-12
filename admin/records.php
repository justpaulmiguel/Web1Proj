<?php
$title = 'Past Records';
require("./partials/head.php");

// functions on record querying
require("./recordQueries.php");

// GET the filter properties
$filterType = isset($_GET['filter']) ? $_GET['filter'] : "date";
$sortType = isset($_GET['sort']) ? $_GET['sort'] : 0;
$specificFilter;

if ($filterType == 'date') {
    $specificFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : date('Y-m-d');
} else if ($filterType == 'state') {
    $specificFilter = $_GET['stateFilters'];
} else if ($filterType == 'email') {
    $specificFilter = $_GET['emailFilter'];
} else if ($filterType == 'service') {
    $specificFilter = $_GET['serviceFilters'];
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
$end = min(($offset + $limit), $total);

// todo configure to use php self to preserve filter details on links
// The "back" link
$prevlink = ($page > 1) ? '<a href="?page=1" title="First page">&laquo;</a> <a href="?page=' . ($page - 1) . '" title="Previous page">&lsaquo;</a>' : '<span class="disabled">&laquo;</span> <span class="disabled">&lsaquo;</span>';

// The "forward" link
$nextlink = ($page < $pages) ? '<a href="?page=' . ($page + 1) . '" title="Next page">&rsaquo;</a> <a href="?page=' . $pages . '" title="Last page">&raquo;</a>' : '<span class="disabled">&rsaquo;</span> <span class="disabled">&raquo;</span>';

// Display the paging information
$pageInfo =  '<div id="paging"><p>' . $prevlink . ' Page ' . $page . ' of ' . $pages . ' page(s). displaying ' . $start . '-' . $end . ' of ' . $total . ' results ' . $nextlink . ' </p></div>';


$query = getQuery($filterType, $limit, $offset, $specificFilter, $sortType);

$records = getRecords($query);

// todo change based from query
$searchTitle = "Recent History"

?>



<main>
    <h1>Past Records</h1>
    <p>Search our records.</p>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="search-record-form">

        <!-- <select name="branch" id="branch" required>
            <option value="" disabled>Select a Filter</option>
            <option value="all" selected>All Branches</option>
            <option value="san simon">San Simon, Pampanga</option>
            <option value="mexico">Mexico, Pampanga</option>
        </select> -->

        <select name="filter" id="filter-select" required>
            <option value="" disabled>Select a Filter</option>
            <option value="date" selected>From Date</option>
            <option value="state">Appointment State</option>
            <option value="email">Email</option>
            <option value="service">Service</option>

        </select>

        <select name="sort" id="sort" required>
            <!-- <option value="select" selected disabled>Select a Filter</option> -->
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
        <a><?= $prevlink ?></a>
        <a><?= $nextlink ?></a>
        <p><?= $pageInfo ?></p>

    <?php else : ?>
        <h2>No Records found!</h2>
    <?php endif ?>
</main>


<?php require("partials/footer.php") ?>