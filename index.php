<!-- Copyright © 2010, 2012 Martin Ueding <dev@martin-ueding.de> -->
<!doctype html>
<html>
	<head>
		<meta charset="utf-8" />
		<title>UrT Config Generator</title>
	</head>
	<body>
	
	<h1>UrT Config Generator</h1>
	
	Hiermit lassen sich Waffen Bindings für UrT erzeugen. Dazu der Reihe nach die Ausrüstung auswählen und dann auf "Weiter" klicken. Je nach dem, was ausgewählt wurde, stehen andere Optionen zur Verfügung. Daher nur den untersten Eintrag ändern, bei Änderungen bitte neu starten.
	
	<br /><br />
	
	<?PHP
	/* Definiere eine Funktion, die Select-Felder (Drop Down) mit Einträgen füllt. Dabei wird auch das Element markiert, was man vorher
	 * ausgewählt hatte. */
	
	function op ($value, $text, $select) {
		if ($select == $value)
			echo '<option value="'.$value.'" selected>'.$text.'</option>';
		else
			echo '<option value="'.$value.'">'.$text.'</option>';
	}
	
	/* Gleiche Funktion wie oben, allerdings werden bei den Items 2 und 3 nicht mehr die Elemente angezeigt, die schon vorher ausgewählt worden sind. In dem Fall bricht die Funktion einfach ab */
	
	function opb ($value, $text, $select, $nummer) {
		if (($nummer == 2 && $value == $_POST['item1']) or ($nummer == 3 && $value == $_POST['item1']) or ($nummer == 3 && $value == $_POST['item2']))
		return;
		
		if ($select == $value)
			echo '<option value="'.$value.'" selected>'.$text.'</option>';
		else
			echo '<option value="'.$value.'">'.$text.'</option>';
	}
	
	/* Die wird nicht mehr gebraucht */
	
	function d ($gruppe) {
		if (!empty($_POST[$gruppe]))
			return ' disabled';
	}
	
	echo '<a href="">Neu starten</a><br><br>';
	
	echo '<form action="index.php" method="post">';
	
	echo '<table border="0" cellpadding="0" cellspacing="7">';
	echo '<tr>';
	echo '<td>Sidearm</td>';
	echo '<td><select name="sidearm" size="1">';
	op('F', 'Beretta 92G', $_POST['sidearm']);
	op('G', 'Desert Eagle', $_POST['sidearm']);
	echo '</select></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<td>Primary</td>';
	echo '<td><select name="primary" size="1">';
	op('H', 'SPAS-12', $_POST['primary']);
	op('I', 'MP5K', $_POST['primary']);
	op('J', 'UMP45', $_POST['primary']);
	op('K', 'HK69', $_POST['primary']);
	op('L', 'LR300ML', $_POST['primary']);
	op('M', 'G36', $_POST['primary']);
	op('N', 'PSG-1', $_POST['primary']);
	op('Z', 'SR-8', $_POST['primary']);
	op('a', 'AK-103', $_POST['primary']);
	op('c', 'Negev LMG', $_POST['primary']);
	op('e', 'Colt M4', $_POST['primary']);
	echo '</select></td>';
	echo '</tr>';
	
	if (!empty($_POST['primary'])) {
		echo '<tr>';
		echo '<td>Secondary</td>';
		echo '<td><select name="secondary" size="1">';
		op('A', '-', $_POST['secondary']);
		if ($_POST['primary'] != 'c') {
			if ($_POST['primary'] != 'H')
				op('H', 'SPAS-12', $_POST['secondary']);
			if ($_POST['primary'] != 'I')
				op('I', 'MP5K', $_POST['secondary']);
			if ($_POST['primary'] != 'J')
				op('J', 'UMP45', $_POST['secondary']);
		}
		echo '</select></td>';
		echo '</tr>';
	}
	
	if (!empty($_POST['secondary'])) {
		echo '<tr>';
		echo '<td>Grenades</td>';
		echo '<td><select name="grenades" size="1">';
		op('A', '-', $_POST['grenades']);
		op('O', 'HE Grenade', $_POST['grenades']);
		op('Q', 'Smoke Grenade', $_POST['grenades']);
		echo '</select></td>';
		echo '</tr>';
	}
	
	if (!empty($_POST['grenades'])) {
		echo '<tr>';
		echo '<td>1st Item</td>';
		echo '<td><select name="item1" size="1">';
		op('R', 'Kevlar Vest', $_POST['item1']);
		op('W', 'Kevlar Helmet', $_POST['item1']);
		op('U', 'Silencer', $_POST['item1']);
		op('V', 'Laser Sight', $_POST['item1']);
		op('T', 'Medkit', $_POST['item1']);
		op('S', 'NVGs (Tac Goggles)', $_POST['item1']);
		op('X', 'Extra Ammo', $_POST['item1']);
		echo '</select></td>';
		echo '</tr>';
	}
	
	if (!empty($_POST['item1'])) {
		echo '<tr>';
		echo '<td>2st Item</td>';
		echo '<td><select name="item2" size="1">';
		if  ($_POST['secondary'] == 'A' || $_POST['grenades'] == 'A') {
			opb('R', 'Kevlar Vest', $_POST['item2'], 2);
			opb('W', 'Kevlar Helmet', $_POST['item2'], 2);
			opb('U', 'Silencer', $_POST['item2'], 2);
			opb('V', 'Laser Sight', $_POST['item2'], 2);
			opb('T', 'Medkit', $_POST['item2'], 2);
			opb('S', 'NVGs (Tac Goggles)', $_POST['item2'], 2);
			opb('X', 'Extra Ammo', $_POST['item2'], 2);
		}
		else
			op('A', '-', $_POST['item2']);
		echo '</select></td>';
		echo '</tr>';
	}
	
	if (!empty($_POST['item2'])) {
		echo '<tr>';
		echo '<td>3st Item</td>';
		echo '<td><select name="item3" size="1">';
		if ($_POST['secondary'] == 'A' && $_POST['grenades'] == 'A') {
			opb('R', 'Kevlar Vest', $_POST['item3'], 3);
			opb('W', 'Kevlar Helmet', $_POST['item3'], 3);
			opb('U', 'Silencer', $_POST['item3'], 3);
			opb('V', 'Laser Sight', $_POST['item3'], 3);
			opb('T', 'Medkit', $_POST['item3'], 3);
			opb('S', 'NVGs (Tac Goggles)', $_POST['item3'], 3);
			opb('X', 'Extra Ammo', $_POST['item3'], 3);
		}
		else
			op('A', '-', $_POST['item3']);
		echo '</select></td>';
		echo '</tr>';
	}
	
	if (empty($_POST['item3'])) {
		echo '<tr>';
		echo '<td></td>';
		echo '<td><input type="submit" value="Weiter" /></td>';
		echo '</tr>';
	}
	
	echo '</table>';
	
	if (!empty($_POST['item3'])) {
		echo '<br /><br />';
		echo 'Schreibe in deine autoexec.cfg:<br />';
		echo '<b>bind X "gear '.$_POST['sidearm'].$_POST['primary'].$_POST['secondary'].$_POST['grenades'].$_POST['item1'].$_POST['item2'].$_POST['item3'].'"</b>';
		echo '<br><br>Dabei bitte das X durch eine beliebige Taste ersetzen.';
	}
	
	echo '</form>';
	
	?>

	</body>
</html>
