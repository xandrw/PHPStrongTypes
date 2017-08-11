# PHPStrongTypes

## Description
This small library consists of a few classes that simulate what _PHP 7+_
is doing with the parameter type hints for all data types.

It does so without having to call any other method on the given instances,
one would only need to call the instance as a function and the magic __invoke
method will be called and it will return the value.

Of course, all types implement a base __toString method that returns the
stringified value of the current type.

Composer autoloading is not included out of the box, but it can be easily
added if you know your way around Composer, namespaces and autoloading.

### Examples
For some concrete examples, this type system has been made in a TDD manner, most examples
are in the **Tests** directory.

Keep in mind that this little package is still in development.
