<?php
// Met deze facade moeten we straks de volgende code kunnen uitvoeren:
//  Permission::has('photo.show');
class Permission extends Facade {
    protected static function getFacadeAccessor() { return 'permission'; }
}