function adduploadfield()
{
	var currentfilesFC = document.getElementById('filecount');
	var currentfiles = currentfilesFC.getAttribute('value');
	currentfiles++;
	
	
	var myfields = document.getElementById('kuploadfiles');
		
	<input type="text"  name="desc1"/>
	<input type="file" name="file1" />
	
	myfields.innerHTML = myfields.innerHTML+'<div>Opis: <input type="input" name="desc'+currentfiles+'"><br />Plik: <input type="file" name="file'+currentfiles+'"></div>';
	
	currentfilesFC.setAttribute('value',currentfiles);
}