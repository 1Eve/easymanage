<?php
/**
 * @package Routes
 */

 namespace Inc;
use Inc\Pages\CreateTables;
use Inc\Pages\UserRoutes;
use Inc\Pages\TaskRoutes;
use Inc\Pages\ProjectRoutes;
 class Init{
     // stores all the class in an array
     public static function get_services(){
         return [
            CreateTables::class,
            UserRoutes::class,
            TaskRoutes::class,
            ProjectRoutes::class,
         ];
     }
 
     // Looping through the classes and initialize them and call the register method if it exists
     public static function register_services(){
         foreach(self::get_services() as $class){
             $service = self::instantiate($class);
             if (method_exists($service, 'register')){
                 $service->register();
             }
         }
     }
 
     // Initialize the class - getting classes from the service array
     // Return new instance of the class
     private static function instantiate($class){
         $service = new $class;
         return $service;
     }
 }