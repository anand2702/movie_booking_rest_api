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

$app->get('/booked_tickets', function(Request $request, Response $response){
    $sql = "SELECT * FROM bookings";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        $db = null;
        echo '{"notice": {"text": "Fetched successfully"}';

        echo json_encode($customers);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

$app->get('/booked_tickets/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "SELECT * FROM bookings WHERE id = $id";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->query($sql);
        $customer = $stmt->fetch(PDO::FETCH_OBJ);
        $db = null;
        echo '{"notice": {"text": "Fetched successfully"}';

        echo json_encode($customer);
    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }
});

// Make bookings
$app->post('/book_ticket', function(Request $request, Response $response){
    //echo "post"."<br>";
    $name = $request->getParam('name');
    $phone = $request->getParam('phone');
    $email = $request->getParam('email');
    $gender = $request->getParam('gender');
    $datentime = $request->getParam('datentime');
    
    
    $sql = "SELECT * FROM bookings where datentime='$datentime'";

    try{
        $db1 = new db();
        $db1 = $db1->connect();
       // echo "try"."<br>";
        $stmt = $db1->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        //echo "try"."<br>"; 
        //echo "printing".$stmt->rowCount()."<br>";
        //echo "try"."<br>";
        $db1 = null;
        if ($stmt->rowCount() <= 19){
        //echo "in if"."<br>";
        
    $status= "Approved";
    $sql = "INSERT INTO bookings (name,phone,email,gender,status,datentime) VALUES
    (:name,:phone,:email,:gender,:status,:datentime)";

    try{
        // Get DB Object
        $db = new db();
        // Connect
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        $stmt->bindParam(':name',       $name);
        $stmt->bindParam(':phone',      $phone);
        $stmt->bindParam(':email',      $email);
        $stmt->bindParam(':gender',    $gender);
        $stmt->bindParam(':status',      $status);
        $stmt->bindParam(':datentime',       $datentime);
        
        $stmt->execute();

        echo '{"notice": {"text": "Booking done"}';

    } catch(PDOException $e){
        echo '{"error": {"text": '.$e->getMessage().'}';
    }

        
    } 
    else{
        echo "Please choose a different time or date";

    }
} 
catch(PDOException $e){
    echo '{"error": {"text": '.$e->getMessage().'}';
}

});



//Update Bookings



$app->put('/update/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');
    $datentime = $request->getParam('datentime');
    $sql = "SELECT * FROM bookings where datentime='$datentime'";
    echo $datentime;
    try{
        $db1 = new db();
        $db1 = $db1->connect();
       // echo "try"."<br>";
        $stmt = $db1->query($sql);
        $customers = $stmt->fetchAll(PDO::FETCH_OBJ);
        //echo "try"."<br>"; 
        //echo "printing".$stmt->rowCount()."<br>";
        //echo "try"."<br>";
        $db1 = null;
        if ($stmt->rowCount() <= 19){
        //echo "in if"."<br>";
        
    

    $sql = "UPDATE bookings SET
                datentime= :datentime
			WHERE id = $id";

    try{
        $db = new db();
        $db = $db->connect();

        $stmt = $db->prepare($sql);

        
        $stmt->bindParam(':datentime',       $datentime);
        

        $stmt->execute();

        echo '{"notice": {"text": "Customer Updated"}';
    }
    
    catch(PDOException $e){
        echo '{"error1": {"text": '.$e->getMessage().'}';
    }}
    else
    {
        echo "Choose different date or/and time";

    }

} 
catch(PDOException $e){
    echo "catch 2";
    echo '{"error2": {"text": '.$e->getMessage().'}';}
});

// Delete Booking
$app->delete('/delete/{id}', function(Request $request, Response $response){
    $id = $request->getAttribute('id');

    $sql = "DELETE FROM bookings WHERE id = $id";

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
});