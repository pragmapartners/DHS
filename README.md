# DHS

This will primarily be a sub-module to the [DCP](https://github.com/pragmapartners/DCP) module.

Contains reusable functions used for drupal development.


#Usage

To call the service:
`$helper = \Drupal::service('custom_services.helper_functions');`

To call a specific function:
`$helper->[some function]();`



#Adding to the project

As this package is not hosted on packagist the following needs to be added to the projects composer.json file:

`"repositories": [ { "type": "vcs", "url": "https://github.com/pragmapartners/DHS" } ],`

Additionally add the following to the require section:

`"require": { "pragmapartners/dhs": "^0.0" },`
