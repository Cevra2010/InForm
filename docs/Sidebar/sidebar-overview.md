# SidebarManager

Der Inform SidebarManager ist die zu kontaktierende Klasse um Elemente in der Sidebar zu ergänzen oder zu manipulieren.

### Elemente der Sidebar hinzufügen

Elemente der Sidebar sind Objekte der Klasse SidebarObjekt. Sie werden mithilfe des SidebarManager´s instanziert.

#### register()
###### Element erstellen
> Zum erstellen eines Elements muss ein möglichst einmaliger Slug angegeben werden.
Über diesen Slug kann erneut auf das Element zugegriffen werden.

```php
/*** 
@return DataTable 
*/
SidebarManager::register('my-sidebar-element');
```
---
#### setName()
> per setName Methode kann dem jeweiligen Element ein Name vergeben werden. Der Name wird anschließend als Linktext angezeigt

```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer');
```
---
#### setRoute()
> per setRoute Methode kann dem Link eine Route zugeweisen werden. Alle weiteren Parameter werden der Route als Route-Parameter mitgegeben.
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer')
    ->setRoute('backend.users');

SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer')
    ->setRoute('backend.user.show','id');
```
---
#### headline()
> Um eine Titelleiste zur Gruppierung einzufügen verwenden Sie die Methode headline()
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzerverwaltung')
    ->headline();
```
---
#### access()
> Um einen Zugriffsbereich für das Element zu definieren nutzen Sie die Methode access(). Wird der Zugriff für diese Area nicht gestattet, wird der Link verborgen.
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer')
    ->setRoute('backend.user.show','id')
    ->access("user.show");
```
---
#### after()
> Alle Elememnte werden grundsätzlich in der Reihenfolge ihrer Instanzierung sortiert. Um die Sortierung abzuändernt können sie mittels after()-Methode ein Element nach dem genannten Element anordnen.
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer')
    ->setRoute('backend.user.show','id')
    ->access("user.show")
    ->after("dashbaord");
```
---
#### icon()
> Möchten Sie einem Element ein benutzerdefiniertes FontAweseome-Icon zuweisen, wählen Sie die Methode icon()
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzer')
    ->setRoute('backend.user.show','id')
    ->access("user.show")
    ->icon("user");
```
---
#### parent()
> Die Inform-Sidebar ist zweidimensional. Jeder "Hauptpunkt" im Menu kann über eine unbestimmte Anzahl an Kind-Elementen verfügen. Soll Ihr erzeugtes Element ein untergeordnetes Element sein, können Sie mittels parent()-Methode das jewils übergeordnete Element angeben.
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Benutzerverwaltung')
    ->access("user")
    ->icon("users");

SidebarManager::register('my-sidebar-element-child')
    ->setName('Benutzerübersicht')
    ->access("user.overview")
    ->parent("my-sidebar-element")
    ->icon("users");
```
---
#### setGate()
> Um ein Gate für ein Sidebar-Element zu definieren wählen Sie die Methode setGate().
```php
SidebarManager::register('my-sidebar-element')
    ->setName('Artikel bearbeiten')
    ->access("article.edit")
    ->setGate('article::can-edit-published-article',$article);
```
