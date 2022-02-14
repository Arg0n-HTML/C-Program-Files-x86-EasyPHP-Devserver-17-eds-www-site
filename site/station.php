<?php
                        // Initialisation de la base de données
try
{
$mysql = new PDO('mysql:host=localhost;dbname=meteo;charset=utf8', 'root', '');
}
catch(Exception $e)
{
die('Erreur : '.$e->getMessage());
}

?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="meteo1.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js" integrity="sha512-TW5s0IT/IppJtu76UbysrBH9Hy/5X41OTAbQuffZFU6lQ1rdcLHzpU5BzVvr/YFykoiMYZVWlr/PX1mDcfM9Qg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <meta charset="utf-8">
	<title>Station métélol</title>
</head>
<body>
    <nav> 
        <img id="logo" src="wyvern2.png">
        <h1 id="Titre">Station Météo Wyvern</h1>
        <h1 id="date"></h1>   
    </nav>

    <section>           <!-- Section Relevé Instantané -->
        <h3 id="releve">Le dernier relevé indique 
            <?php $sql = ('SELECT temperature FROM tablemeteo ORDER BY date DESC LIMIT 1');
foreach ($mysql->query($sql) as $row) {
     print $row['temperature'] . "\n";
        } ;?> 
        °C avec 
            <?php $sql = ('SELECT hygrometrie FROM tablemeteo ORDER BY date DESC LIMIT 1');
foreach ($mysql->query($sql) as $row) {
     print $row['hygrometrie'] . "\n";
} ;?>
% d'humidité </h3>
</section>              <!-- Section Relevé Instantané -->
    
                        <!-- Section Graphique Température -->
    <div id="graphiques">
       <div id="graphique1">
            <h2 id="titre">Graphique de la Température <img id="icone" src="thermometre.png"></h2>
            <canvas id="graph1"></canvas>
        </div>

                        <!-- Section Graphique Hydromètrie -->
        <div id="graphique2">
            <h2 id='titre'>Graphique de l'Hydrométrie <img id="icone" src="hygro.png"></h2>
            <canvas id="graph2"></canvas>
         </div>
    </div>

    <div id="coindecouverte">
        <div>
            <h1 id="h1decouverte">Le coin découverte!</h1>
        </div>
        <div>
            <p id="h1decouverte">La température maximale : <?php $sql = 'SELECT temperature FROM tablemeteo ORDER BY temperature DESC LIMIT 1';
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";
}?>°C</p>
        </div>
        <div>
            <p id="h1decouverte">La température minimale : <?php $sql = 'SELECT temperature FROM tablemeteo WHERE temperature IS NOT NULL ORDER BY temperature LIMIT 1';
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";
}?>°C</p>
        </div>
        <div>
            <p id="h1decouverte">Le taux d'humidité le plus élevé : <?php $sql = 'SELECT hygrometrie FROM tablemeteo ORDER BY hygrometrie DESC LIMIT 1';
foreach ($mysql->query($sql) as $row) {
    print $row['hygrometrie'] . "\n";}?>%</p>
        </div>
        <div>
            <p id="h1decouverte">Le taux d'humidité le plus bas : <?php $sql = 'SELECT hygrometrie FROM tablemeteo WHERE hygrometrie IS NOT NULL ORDER BY hygrometrie ASC LIMIT 1';
foreach ($mysql->query($sql) as $row) {
    print $row['hygrometrie'] . "\n";}?>%</p>
    
        </div>
        <div>
            <p id="h1decouverte">La température maximale pendant l'été : <?php $sql = "SELECT temperature FROM tablemeteo where (date between '2022-06-21 00:00:00' and '2022-09-23 00:00:00') order by date ASC LIMIT 1'";
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";}?>°C</p>
        </div>
        <div>
            <p id="h1decouverte">La température maximale pendant l'automne : <?php $sql = "SELECT temperature FROM tablemeteo where (date between '2022-09-23 00:00:00' and '2022-12-21 00:00:00') order by date ASC LIMIT 1'";
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";} ;?>°C</p>
        </div>
        <div>
            <p id="h1decouverte">La température maximale pendant l'hiver : <?php $sql = "SELECT temperature FROM tablemeteo where (date between '2022-12-21 00:00:00' and '2022-03-21 00:00:00') order by date ASC LIMIT 1";
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";};?>°C</p>
        </div>
        <div>
            <p id="h1decouverte">La température maximale pendant le printemps : <?php $sql = "SELECT temperature FROM tablemeteo where (date between '2022-03-21 00:00:00' and '2022-06-21 00:00:00') order by date ASC LIMIT 1";
foreach ($mysql->query($sql) as $row) {
    print $row['temperature'] . "\n";};?>°C</p>
        </div>
    </div>
</body>
</html>

                            <!-- Script pour la date dans la navigation -->
<script 
    type="text/javascript">var d = new Date();
    var date = d.getDate()+' / '+(d.getMonth()+1)+' / '+d.getFullYear();
    console.log(date);
    document.getElementById('date').innerHTML = date;
</script>
                            <!-- Script pour la date dans la navigation -->

                            <!-- Script pour le graphique 1-->
<script>
    var ctx = document.getElementById('graph1').getContext('2d')
    var data = {
        labels: [ <?php $sql = 'SELECT date FROM tablemeteo WHERE id=1';
foreach ($mysql->query($sql) as $row) {
   print $row['date'] . "\t"; }?>,
                <?php $sql = 'SELECT date FROM tablemeteo WHERE id=2';
foreach ($mysql->query($sql) as $row) {
   print $row['date'] . "\t"; }?>,
                <?php $sql = 'SELECT date FROM tablemeteo WHERE id=3';
foreach ($mysql->query($sql) as $row) {
   print $row['date'] . "\t"; }?>,
                <?php $sql = 'SELECT date FROM tablemeteo WHERE id=4';
foreach ($mysql->query($sql) as $row) {
   print $row['date'] . "\t"; }?>],
        datasets: [{
            label: "Température en degrés",
            data: [
                <?php $sql = 'SELECT temperature FROM tablemeteo WHERE id=1';
foreach ($mysql->query($sql) as $row) {
   print $row['temperature'] . "\t"; }?>,
                <?php $sql = 'SELECT temperature FROM tablemeteo WHERE id=2';
foreach ($mysql->query($sql) as $row) {
   print $row['temperature'] . "\t"; }?>,
                <?php $sql = 'SELECT temperature FROM tablemeteo WHERE id=3';
foreach ($mysql->query($sql) as $row) {
   print $row['temperature'] . "\t"; }?>,
                <?php $sql = 'SELECT temperature FROM tablemeteo WHERE id=4';
foreach ($mysql->query($sql) as $row) {
   print $row['temperature'] . "\t"; }?>
            ]
        }]
    }

    var options

    var config = {
        type: 'line',
        data: data,
        options: options
    }
    var graph1 = new Chart(ctx, config)
</script>
                            <!-- Script pour le graphique-->

                            <!-- Script pour le graphique 2-->
<script>
    var ctx = document.getElementById('graph2').getContext('2d')
    var data = {
        labels: ['2019', '2020', '2021','2022'],
        datasets: [{
            label: "Hygrométrie en %",
            data: [1,5,7,3]             
               
        }]
    }

    var options = {
        title: "Titre"
    }

    var config = {
        type: 'line',
        data: data,
        options: options
    }
    var graph1 = new Chart(ctx, config)
</script>
                            <!-- Script pour le graphique 2-->






<!-- // $reponse1 = $mysql->query('SELECT SUM(temperature);');
// $reponse2 = $mysql->query('SELECT temperature FROM tablemeteo;');
// $data1 = $reponse1->fetch();
// $data2 = $reponse2->execute();
// ?>

//$sql = 'SELECT date, temperature FROM tablemeteo WHERE id=1';
//foreach ($mysql->query($sql) as $row) {
//   print $row['date'] . "\t";
// print $row['temperature'] . "\n";
//}