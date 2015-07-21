# Laravel User Privilege Mapper

This package implements a simple Service Provider that enables mapping of user privileges independent of the implementation of the User model. It uses Laravel macros() to create an interface between a user privilege test and the actual implementation of the code to check whether the current user has this privilege enabled.

I use this package to allow my other packages to test for security privileges without having to dictate how the user model is defined within a project.

## Installation

1. Require this package in your composer.json and run composer update (or run `composer require vsch/user-privilege-mapper:*` directly):

        "vsch/user-privilege-mapper": "1.*"

2. After updating composer, add the ServiceProviders to the providers array in app/config/app.php and comment out the original TranslationServiceProvider:

        'Vsch\UserPrivilegeMapper\UserPrivilegeMapperServiceProvider',

3. add the Facade to the aliases array in app/config/app.php:

        'UserCan' => 'Vsch\UserPrivilegeMapper\Facade\Privilege',

4. To create a mapping layer between your User model implementation and the need to test user privileges without knowing the implementation. You need to create named privileges for the UserPrivilegeMapper via the Laravel macro mechanism. This should be done in the initialization files. A good place is the filters.php file, add the following if your User model has is_admin and is_editor attributes to identify users that have Admin and Editor privileges:

        UserCan::macro("admin", function ()
        {
            return ($user = Auth::user()) && $user->is_admin;
        });

        UserCan::macro("edit", function ()
        {
            return ($user = Auth::user()) && ($user->is_admin || $user->is_editor);
        });

5. Testing whether a privilege is available is as simple as:

        if (UserCan::admin())
        {
            // user has admin privileges
        }
        elseif (UserCan::edit())
        {
            // user has edit privileges
        }

If a macro was not previously defined then the privilege test will return false. Effectively, if the macro is not implemented then the privilege is treated as not existent for every user.

The implementation is more of a convention that is implemented by Laravel's MacroableTrait. I don't see this package changing unless I get an epiphany. So consider this package code complete. However, suggestions are appreciated and welcome. :)
