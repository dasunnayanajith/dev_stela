<?php
session_start();
error_reporting(0);
include('includes/config.php');

$msg = "";
$error = "";

// Handle form submission
if(isset($_POST['submit'])) {
    $packageid = $_POST['packageid'];
    $dateActivities = $_POST['activities'];

    // Update existing activities
    foreach($dateActivities as $dateid => $activities) {
        foreach($activities as $activityId => $activityDetails) {
            $activityName = $activityDetails['name'];
            $sql = "UPDATE tbltouractivities SET ActivityName = :activityname WHERE PackageId = :packageid AND DateId = :dateid AND ActivityName = :activityid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':activityname', $activityName, PDO::PARAM_STR);
            $query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
            $query->bindParam(':dateid', $dateid, PDO::PARAM_INT);
            $query->bindParam(':activityid', $activityId, PDO::PARAM_STR);
            $query->execute();
        }
    }

    // Insert new activities
    if(isset($_POST['new_activities'])) {
        $newActivities = $_POST['new_activities'];
        foreach($newActivities as $newActivity) {
            $dateid = $newActivity['dateid'];
            $activityName = $newActivity['name'];
            $sql = "INSERT INTO tbltouractivities (PackageId, DateId, ActivityName) VALUES (:packageid, :dateid, :activityname)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
            $query->bindParam(':dateid', $dateid, PDO::PARAM_INT);
            $query->bindParam(':activityname', $activityName, PDO::PARAM_STR);
            $query->execute();
        }
    }

    $msg = "Activities Updated Successfully";
}

// Delete an activity
if(isset($_GET['del']) && isset($_GET['pkgid']) && isset($_GET['dateid'])) {
    $activityName = $_GET['del'];
    $dateId = intval($_GET['dateid']);
    $packageId = intval($_GET['pkgid']);
    $sql = "DELETE FROM tbltouractivities WHERE PackageId = :packageid AND DateId = :dateid AND ActivityName = :activityname";
    $query = $dbh->prepare($sql);
    $query->bindParam(':packageid', $packageId, PDO::PARAM_INT);
    $query->bindParam(':dateid', $dateId, PDO::PARAM_INT);
    $query->bindParam(':activityname', $activityName, PDO::PARAM_STR);
    $query->execute();
    $msg = "Activity Deleted Successfully";
}

// Fetch activities for a specific PackageId
$packageid = isset($_GET['pkgid']) ? intval($_GET['pkgid']) : 0;
$sql = "SELECT * FROM tbltouractivities WHERE PackageId = :packageid";
$query = $dbh->prepare($sql);
$query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
$query->execute();
$activities = $query->fetchAll(PDO::FETCH_ASSOC);

// Group activities by DateId
$groupedActivities = [];
foreach ($activities as $activity) {
    $groupedActivities[$activity['DateId']][] = $activity;
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Manage Activities</title>
    <link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        .succWrap{
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
            box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
        }
        table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3>Manage Activities</h3>
        <a href="update-package.php?pid=<?php echo intval($_GET['pid']; ?>" class="btn btn-primary">Back</a>

        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

        <form action="" method="post">
            <div class="form-group">
                <label for="packageid">Package ID</label>
                <input type="text" class="form-control" name="packageid" id="packageid" value="<?php echo htmlentities($packageid); ?>" readonly>
            </div>

            <div id="activity-container">
                <?php foreach ($groupedActivities as $dateid => $activities): ?>
                <h4>Date ID: <?php echo htmlentities($dateid); ?></h4>
                <table>
                    <thead>
                        <tr>
                            <th>Activity Name</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($activities as $activity): ?>
                        <tr id="activity-row-<?php echo htmlentities($activity['ActivityName']); ?>">
                            <td><input type="text" class="form-control" name="activities[<?php echo htmlentities($dateid); ?>][<?php echo htmlentities($activity['ActivityName']); ?>][name]" value="<?php echo htmlentities($activity['ActivityName']); ?>" required></td>
                            <td><a href="manage_activities.php?pkgid=<?php echo $packageid; ?>&dateid=<?php echo $dateid; ?>&del=<?php echo urlencode($activity['ActivityName']); ?>" onclick="return confirm('Are you sure you want to delete this activity?');" class="btn btn-danger">Remove</a></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php endforeach; ?>
            </div>

            <div id="new-activity-container">
                <!-- New activities will be added here -->
            </div>
            <button type="button" id="add-new-activity" class="btn btn-success">Add New Activity</button>
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let newActivityCount = 0;

            $('#add-new-activity').click(function() {
                newActivityCount++;
                let newActivityHtml = `
                <div class="form-group" id="new-activity-group-${newActivityCount}">
                    <label for="new_activity_dateid_${newActivityCount}">Date ID</label>
                    <input type="text" class="form-control" name="new_activities[${newActivityCount}][dateid]" id="new_activity_dateid_${newActivityCount}" placeholder="Enter Date ID" required>
                    <label for="new_activity_name_${newActivityCount}">Activity Name</label>
                    <input type="text" class="form-control" name="new_activities[${newActivityCount}][name]" id="new_activity_name_${newActivityCount}" placeholder="Enter Activity Name" required>
                    <button type="button" class="btn btn-danger remove-new-activity" data-group="${newActivityCount}">Remove</button>
                </div>`;
                
                $('#new-activity-container').append(newActivityHtml);
            });

            // Remove new activity fields
            $('#new-activity-container').on('click', '.remove-new-activity', function() {
                var groupId = $(this).data('group');
                $('#new-activity-group-' + groupId).remove();
            });
        });
    </script>
</body>
</html>
