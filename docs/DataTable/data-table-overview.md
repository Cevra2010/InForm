# DataTable

Die Inform DataTable bietet die Möglichkeit durch angabe eines Models, Daten in einer interaktiven Tabelle darzustellen.

### DataTable erstellen und Grundlagen

Datentabellen Werden Grundlegend Im Via Boot() Methode Im Jeweiligen Serviceprovider Registriert, Um üBerall Ansprechbar Zu Sein

#### create()
###### DataTable erstellen
> Zum erstellen einer DataTable muss ein möglichst einmaliger Slug angegeben werden.
Über diesen Slug kann erneut auf die DataTable zugegriffen werden.

```php
/*** 
@return DataTable 
*/
DataTable::create('my-module::my-data-table-slug');
```

------------


#### setModelBinding()
###### ModelBinding
> Um eine Datenquelle zu definieren, wird das jeweilige Model mittels setModelBinding() methode angegeben

```php
DataTable::create('my-module::my-data-table-slug')
	->setModelBinding(User::class);
```

------------


#### get()
###### Auf bestehende Instanz zugreifen
>Um auf eine bestehende DataTable Instanz zuzugreifen verwenden sie folgende Methode

```php
$myDataTable = DataTable::get('my-module::my-data-table-slug');
```

------------

#### x-inform-data-table
###### Tabelle rendern
>Um die Tabelle in ihrer .balde.php-Datei zu rendern, greifen Sie über die folgende Blade-Componente auf die Tabelle zu.

```html
<x-inform-data-table table="my-module::my-data-table-slug" />
```
> Zusätzliche Daten können in der Laufzeit angegeben und zu späteren Zeitpunkten verarbeitet werden
```html
<x-inform-data-table table="my-module::my-data-table-slug" :data="['group_id' => $group->id]"/>
```

## Umgang mit Daten
Jede Aufruf einer Methode, welche Daten in die DataTable hineingibt, gibt grundsätzlich die eigene Instanz als return zurück. Somit kann aufbauend und mit schönem, gut lesbarem Code gearbeitet werden.

#### addColumn()
###### Eine Tabellenspalte hinzufügen 
> Geben Sie bei vor dem Rendern der Tabelle keine anzuzeigenden Spalten an, werden alle Spalten der Tabelle gerendert.
Möchten Sie nur bestimmt Spalten anzeigen und die ggf. modifizeiren verwenden Sie folgende Methode

```php
DataTable::get('my-module::my-data-table-slug')
	->addColumn('firstname','Vorname')
```

###### Casting
> Beinhaltet ihre Spalte einen speziellen Datentypen, welcher gecastet werden muss (z.B. DateTime) können sie mittls dem dritten Parameter ein Cast-Parameter angeben.
Im Bereich ``[http://Casts](http://Casts)`` könne Sie weitere Informationen zum Casting erhalten.

```php
DataTable::get('my-module::my-data-table-slug')
	->addColumn('created_at','Erstellt am','datetime')
```

------------


#### addAction()
###### Eine Spaltenaktion hinzufügen
> Oft sind direkte Interaktionen mit einem Element einer Spalte gewünscht. Hierfür können Spaltenaktionen definiert werden.
Es kann eine beliebige Anzahl an Route-Parametern angegeben werden.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
```
------------
#### linkRows()
###### Gesamte Zeile verlinken
> Um die gesamte Tabellenzeile zu verlinken verwende Sie die methode linkRows().

```php
DataTable::get('my-module::my-data-table-slug')
	->linkRows('my-route','id');
```
------------
#### confirmation()
###### Bestätigung einer Aktion erfragen
> In machen fällen kann es dazu kommen, dass vor Durchführung einer Aktion eine Sicherheitsabfrage stattfinden soll. In der Regel findet solch ein prozedere beim löschen eines Datensatzes statt.
Hierzu kann eine solche Bestätigung per confirmation() methode abgefragt werden.
Per angebe einer Callback-Funktion kann aus der bestätigung eine Aktion definiert werden.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Löschen','backend.user.delete','id')
	->confirmation(
			function($tableRow) {
				User::find($tableRow['id'])->delete();
			},
		'Benutzer wirklich löschen?'
	);
```
--------
## Sortieren

#### unsortable()
###### Sortierung deaktivieren
> Grundsätzlich ist die Sortierfunktion für jede DataTable aktiviert. Soll diese für die gesamte Tabelle deaktivert werden, nutze Sie die unsortable() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addColumn('created_at','Erstellt am','datetime')
	->addAction('Bearbeiten','my-route.edit','id')
	->unsortable();
```
------------
#### sortOnly()
###### Sortierung nur bestimmter Spalten
> Um eine Sortierung nur bestimmter Spalten zu aktivieren, nutzen Sie die sortOnly() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->sortOnly([
		'id',
		'firstname'
	]);
```
------------
#### sortExpect()
###### Spalten von Sortierung aussschließen
> Um eine oder mehrer Spalten von der Sortierung auszuschließen, verwende Sie die sortExpect() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->sortExpect([
		'id',
		'firstname'
	]);
```
------------
## Suchen

#### disableSearch()
###### Suche deaktivieren
> Grundsätzlich ist die Suchfunktion für jede DataTable aktiviert. Soll diese für die gesamte Tabelle deaktivert werden, nutze Sie die disbaleSearch() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addColumn('created_at','Erstellt am','datetime')
	->addAction('Bearbeiten','my-route.edit','id')
	->disableSearch();
```
------------
#### searchOnly()
###### Suche nur in bestimmter Spalten
> Um eine Suche nur bestimmter Spalten zu aktivieren, nutzen Sie die searchOnly() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->searchOnly([
		'id',
		'firstname'
	]);
```
------------
#### searchExpect()
###### Spalten von Suche aussschließen
> Um eine oder mehrer Spalten von der Suche auszuschließen, verwende Sie die searchExpect() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->searchExpect([
		'id',
		'firstname'
	]);
```
------------
#### addWhereCondition()
###### Daten selektieren
> Um Daten vor dem Datenbankkontakt zu selektieren steht ihnen die addWhereCodition()-methode zu verfügung.
> Durch diese Methode können Sie auf Service-Provider Ebene Daten filtern.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->addWhereCondition('age','>',20)
	->addWhereCondition('is_admin','==',true)
	->addWhereCondition('is_admin',true);
```

> Sie können auf ebenfalls auf alle Data-Parameter für den späteren abruf einer Where-Condition zugreifen

```html
<x-inform-data-table table="newsfeed::my-data-table-slug" :data="['is_admin' => $group->is_admin]"/>
``````

```php
DataTable::get('my-module::my-data-table-slug')
	->addWhereCondition('is_admin');
```
------------
## Styling

#### icon()
###### Icon hinzufügen (Fontawesome-Free)
> Um einer Tabellenspalte oder einer Aktion ein Icon hinzufügen, verwenden Sie nach deren definition die icon() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->icon('edit');
	
	DataTable::get('my-module::my-data-table-slug')
	->addColumn('username','Benutzername')
	->icon('user');
```
------------
#### css()
###### CSS hinzufügen
> Um einer Tabellenspalte oder einer Aktion eine oder mehrere CSS-Klasse hinzufügen, verwenden Sie nach deren definition die css() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->css('text-teal-500');
	
	DataTable::get('my-module::my-data-table-slug')
	->addColumn('username','Benutzername')
	->css('text-slate-500 underline');
```
------------
#### headerUppercase()
###### Kopfzeile in Großbuchstaben
> Um die Kopfzeile in Großbuchstaben darzustellen verwenden Sie die headerUppercase() methode.

```php
DataTable::get('my-module::my-data-table-slug')
	->addAction('Bearbeiten','my-route.edit','id')
	->css('text-teal-500')
	->headerUppercase();
```
--------
## Callbacks
#### callback()
###### Callback-Funktion für Spalte einrichten
> In machen fällen kann es dazu kommen, dass Sie Werte aus der Datenbank nachträglich manipolieren oder weiterverarbeiten möchten. Hierzu können Sie einer Tabellenspalte eine Callback-Funktion übergeben.
Innerhalb der Callback-Funktion ist der Datensatz der gesamten Tabellenzeile verfügbar.

```php
DataTable::get('my-module::my-data-table-slug')
	->addColumn('id','ID')
	->addColumn('new_old','Neu oder alt?')
		->callback(function($row) {
			if($row->id > 100) {
				return 'Alt',
			}
			return 'Neu';
		});
```


