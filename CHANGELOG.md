# Release Notes

## [v0.1.2 (2021-07-21)](https://github.com/AntanasGa/XmlRpcDecode/compare/v0.1.1...v0.1.2)

### Changed
- **Complete rewrite** functionality retained for legacy
- **Bugfix**: Arrays with one value collapse
- Added throwable parameter to `Decode` construct function (not required to retain legacy)
- Added XML error management, when XML can not be parsed
- Moved variables type parsing to static functions
- Simplified variable type implementation in Value class
