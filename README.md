# Configuration $$VERSION$$

goals:

- drop php dot env (uses global state so can't be used for multiple environments simultaneously in a runtime)
- add new configuration loader / reader
- keep env file conventions

warning:

config can be used in component boostrapping bind() methods but only within bound closures. the configuration tool needs the bootstrap bind() phase to set itself up.
