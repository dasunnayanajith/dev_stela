<?php
session_start();
error_reporting(0);
include('includes/config.php');

$msg = "";
$error = "";

// Delete a highlight
if(isset($_GET['pkgid']) && isset($_GET['del'])) {
    $highlightId = intval($_GET['del']);
    $packageId = intval($_GET['pkgid']);
    $sql = "DELETE FROM tbltourpkghiglight WHERE HighlightId = :highlightid AND PackageId = :packageid";
    $query = $dbh->prepare($sql);
    $query->bindParam(':highlightid', $highlightId, PDO::PARAM_INT);
    $query->bindParam(':packageid', $packageId, PDO::PARAM_INT);
    $query->execute();
    $msg = "Highlight Deleted Successfully";
}

if(isset($_POST['submit'])) {
    $packageid = $_POST['packageid'];
    $highlights = $_POST['highlights'];

    // Update existing highlights
    foreach($highlights as $highlightId => $highlightItem) {
        $sql = "UPDATE tbltourpkghiglight SET HighlightItem = :highlightitem WHERE HighlightId = :highlightid AND PackageId = :packageid";
        $query = $dbh->prepare($sql);
        $query->bindParam(':highlightitem', $highlightItem, PDO::PARAM_STR);
        $query->bindParam(':highlightid', $highlightId, PDO::PARAM_INT);
        $query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
        $query->execute();
    }

    // Insert new highlights
    if(isset($_POST['new_highlights'])) {
        $newHighlights = $_POST['new_highlights'];
        foreach($newHighlights as $newHighlightItem) {
            $sql = "INSERT INTO tbltourpkghiglight (PackageId, HighlightItem) VALUES (:packageid, :highlightitem)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
            $query->bindParam(':highlightitem', $newHighlightItem, PDO::PARAM_STR);
            $query->execute();
        }
    }

    $msg = "Highlights Updated Successfully";
}



// Fetch highlights for a specific PackageId
$packageid = isset($_GET['pkgid']) ? intval($_GET['pkgid']) : 0;
$sql = "SELECT * FROM tbltourpkghiglight WHERE PackageId = :packageid";
$query = $dbh->prepare($sql);
$query->bindParam(':packageid', $packageid, PDO::PARAM_INT);
$query->execute();
$highlights = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Manage Package Highlights</title>
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
    </style>
</head>
<body>
    <div class="container">
        <h3>Manage Package Highlights</h3>
        <a href="update-package.php?pid=<?php echo $pid; ?>" class="btn btn-primary">Back<?php echo $pid; ?></a>

        <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
        else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

        <form action="" method="post">
            <div class="form-group">
                <label for="packageid">Package ID</label>
                <input type="text" class="form-control" name="packageid" id="packageid" value="<?php echo htmlentities($packageid); ?>" readonly>
            </div>

            <div id="highlight-container">
                <?php foreach($highlights as $highlight): ?>
                <div class="form-group" id="highlight-group-<?php echo $highlight['HighlightId']; ?>">
                    <label for="highlight<?php echo $highlight['HighlightId']; ?>">Highlight <?php echo $highlight['HighlightId']; ?></label>
                    <input type="text" class="form-control" name="highlights[<?php echo $highlight['HighlightId']; ?>]" id="highlight<?php echo $highlight['HighlightId']; ?>" value="<?php echo htmlentities($highlight['HighlightItem']); ?>" required>
                    <a href="manage_highlights.php?pkgid=<?php echo $packageid; ?>&del=<?php echo $highlight['HighlightId']; ?>" onclick="return confirm('Are you sure you want to delete this highlight?');" class="btn btn-danger">Remove</a>
                </div>
                <?php endforeach; ?>
            </div>

            <div id="new-highlight-container"></div>
            <button type="button" id="add-new-highlight" class="btn btn-success">Add New Highlight</button>
            <button type="submit" name="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            let newHighlightCount = 0;

            $('#add-new-highlight').click(function() {
                newHighlightCount++;
                let newHighlightHtml = `
                <div class="form-group" id="new-highlight-group-${newHighlightCount}">
                    <label for="new_highlight${newHighlightCount}">New Highlight</label>
                    <input type="text" class="form-control" name="new_highlights[]" id="new_highlight${newHighlightCount}" placeholder="Enter New Highlight" required>
                    <button type="button" class="btn btn-danger remove-new-highlight" data-id="${newHighlightCount}">Remove</button>
                </div>`;
                
                $('#new-highlight-container').append(newHighlightHtml);
            });

            $(document).on('click', '.remove-new-highlight', function() {
                let id = $(this).data('id');
                console.log('Removing highlight with id:', id);  // Debugging statement
                $('#new-highlight-group-' + id).remove();
            });
        });

    </script>
</body>
</html>
