# Programs for Moodle

## Overview

_Programs for Moodle_ by Open LMS is a set of plugins that implements programs,
also known as learning pathways.

Main features include:

* program content created as a hierarchy of courses and course sets with flexible sequencing rules,
* _Program catalogue_ where students may browse available programs and related courses,
* multiple sources for allocation of students to programs,
* advanced program scheduling settings,
* efficient course enrolment automation,
* _My programs_ dashboard block,
* easy-to-use program management interface.

See [Use cases](./docs/en/use_cases.md) and [Program management](./docs/en/management.md)
documentation pages for more information.

## Installation

**This code is not yet suitable for production use.**

_Programs for Moodle_ consists of the following plugins published on GitHub:

* [moodle-enrol_programs](https://github.com/open-lms-open-source/moodle-enrol_programs)
* [moodle-block_myprograms](https://github.com/open-lms-open-source/moodle-block_myprograms)
* [moodle-local_openlms](https://github.com/open-lms-open-source/moodle-local_openlms)

There are no special installation instructions, _My programs_ block is automatically added
to all dashboards during installation.

Plugins are compatible with latest Moodle 3.11.x and Moodle 4.0.x releases. Some features
that require Moodle core changes might be available only in OLMS Work 1.0.x, we are
planning to submit our changes upstream soon.

Unsupported environments:

* PHP 7.3 is not supported, use PHP 7.4 or PHP 8.0 instead
* PHP for Windows is not supported, use Windows Subsystem for Linux if necessary
* Oracle Databases are not supported

## Feedback

Before proposing a new feature or reporting problems please read
[Known problems and future plans](./docs/en/plans.md).

You can use [Feedback form](https://form.asana.com/?k=oMNm1HIGalQh5DD42RQ7OA&d=36833584313346)
if you want to leave feedback privately or feel free to comment on the original
announcement post on moodle.org.

## Release plan

Open LMS is planning to release a new Alpha version on GitHub every 2 or 3 weeks.
Expected production release date will be announced after all required features
are implemented and codebase has full test coverage.