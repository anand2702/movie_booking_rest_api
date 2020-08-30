<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

$app = new \Slim\App;

$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
});


//Update Bookings



function change(){
    $status = "Expired";
    $sql = "UPDATE bookings SET
            status= :status

			WHERE TIMEDIFF(SYSDATE(),datentime) > '08:00:00'";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        
        $stmt->bindParam(':status',       $status);
        
        $stmt->execute();

        echo '{"notice": {"text": "Customer Updated"}';
    }
    
    catch(PDOException $e){
        echo '{"error1": {"text": '.$e->getMessage().'}';
    }
}

// Delete Booking
function del(){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM bookings WHERE status = 'Expired'";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);
        $stmt->execute();
        $db = null;
        echo '{"notice": {"text": "Ticket Deleted"}';
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
}
change();
del();