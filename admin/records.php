<?php
$title = 'Past Records';
require("./partials/head.php");

// functions on record queries
require("./recordQueries.php");

// get the GET request properties
$filterType = isset($_GET['filter']) ? $_GET['filter'] : "date";
$sortType = isset($_GET['sort']) ? $_GET['sort'] : 0;
$specificFilter;
$filterName = '';
$searchTitle = "Search Result for ";

if ($filterType == 'date') {
    $dateToday = date('Y-m-d');
    $specificFilter = isset($_GET['dateFilter']) ? $_GET['dateFilter'] : $dateToday;
    $filterName = 'dateFilter';
    if ($dateToday == $specificFilter) {
        $searchTitle = 'Recent Records';
    } else {
        $searchTitle .= "'$specificFilter' and older date";
    }
} else if ($filterType == 'state') {
    $specificFilter = $_GET['stateFilters'];
    $filterName = 'stateFilters';
    $searchTitle .= "'$specificFilter' status";
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
echo $page;

$page = $page <= 0 ? 1 : $page;

$offset = ($page - 1)  * $limit;


// Some information to display to the user
$start = $offset + 1;
$end = min(($offset + $limit), $count);

// anchor link for pagination url
$linkName = '?' . 'filter=' . $filterType . '&sort=' . $sortType . '&' . $filterName;


$query = getQuery($filterType, $limit, $offset, $specificFilter, $sortType);
$records = getRecords($query);
function getServiceName($code)
{
    if ($code == 'clean') {
        return 'Cleaning';
    } else if ($code == 'd_crown') {
        return 'Crown';
    } else if ($code == 'pasta') {
        return 'Pasta';
    } else if ($code == 'wisdom') {
        return 'Wisdom Tooth Extraction';
    }
}
function getBranchName($code)
{
    if ($code == 's_simon') {
        return 'San Simon';
    } else if ($code == 'mexico') {
        return 'Mexico';
    }
}
?>



<main>
    <h1>History Records</h1>
    <p>Search our records.</p>

    <div class="section-content">
        <h3>Filter By:</h3>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" id="search-record-form">
            <select name="filter" id="filter-select" required>
                <option value="" disabled>Select a Filter</option>
                <option value="date" selected> Date</option>
                <option value="state">Appointment Status</option>
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
    </div>
    <div class="section-content">
        <?php if (!empty($records)) : ?>
            <h3> <?= $searchTitle ?></h3>
            <table>
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Branch</th>
                        <th>Name</th>
                        <th>Service</th>
                        <th>Account ID</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($records as $record) : ?>
                        <tr align="center" class="patient-req-row">
                            <td><?= $record['date'] ?></td>
                            <td><?= $record['time'] ?></td>
                            <td><?= $record['state'] ?></td>
                            <td><?= getBranchName($record['branch']); ?></td>
                            <td><?= $record['lname'] . ", " .  $record['fname']; ?></td>
                            <td><?= getServiceName($record['service'])  ?></td>
                            <td><?= $record['account_ID']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="control-btns">
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
            </div>
        <?php endif ?>
        <div id="paging">
            <p> <?=
                /**Page Information*/
                ' Page ' . $page . ' of ' . $pages . ' page(s). displaying ' . $start . '-' . $end . ' of ' . $count . ' results ' ?>
            </p>
        </div>
    <?php else : ?>
        <h2>No Records about that yet!</h2>
    <?php endif ?>
    </div>
</main>


<?php require("partials/footer.php") ?>