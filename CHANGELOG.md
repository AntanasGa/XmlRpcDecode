# Release Notes

## [v0.1.4 (2021-08-02)](https://github.com/AntanasGa/XmlRpcDecode/compare/v0.1.3...v0.1.4)

### Bugfixes
- [No correct error handling post rewrite (v0.1.2)](https://github.com/AntanasGa/XmlRpcDecode/issues/3)
- Removed variables from interface

### Changed
***none***

### Added
***none***

## [v0.1.3 (2021-07-22)](https://github.com/AntanasGa/XmlRpcDecode/compare/v0.1.2...v0.1.3)

### Bugfixes
- [Variable parsing throws error with unexpected value of 0](https://github.com/AntanasGa/XmlRpcDecode/issues/2)

### Changed
***none***

### Added
- Test case for same XML string but with whitespace (read more in [Bugfixes](#Bugfixes))

## [v0.1.2 (2021-07-21)](https://github.com/AntanasGa/XmlRpcDecode/compare/v0.1.1...v0.1.2)

**Complete rewrite** functionality retained for legacy

### Bugfixes
- Arrays with one value collapse

### Changed
- Moved variables type parsing to static functions
- Simplified variable type implementation in Value class

### Added
- Throwable parameter to `Decode` construct function (not required to retain legacy)
- XML error management, when XML can not be parsed
