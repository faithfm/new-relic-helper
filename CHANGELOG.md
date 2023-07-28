# Changelog

The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]

No unreleased changes

## 1.0.4 - 2023-07-28

### Modified

* Add "PHP-H ..." prefix to app names configured through the helper

## 1.0.3 - 2023-07-27

### Added

* Check for existence of config() function (caused error in faithserver-v1)

## 1.0.2 - 2023-07-27

### Removed

* Removed Laravel dependencies.

## 1.0.1 - 2023-07-27

### Added

* Allow detection of APP_NAME for non-Laravel entry points

## 1.0.0 - 2023-07-27

FIRST PUBLISHED

### Added

* Created repo as new composer package - cloned from local library class
* Added automatic boot() ServiceProvider function to automatically register New Relic APM app name.
