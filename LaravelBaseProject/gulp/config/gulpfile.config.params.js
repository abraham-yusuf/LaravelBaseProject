//gestisce i parametri passati al gulp di environment con minimist

const minimist = require('minimist');

const knownOptions = {
    string: ['env', 'pub'],
    boolean: ['mayor'],
    default: {
        env: 'development',
        pub: '',
        mayor: false
    }
};

module.exports = minimist(process.argv.slice(2), knownOptions);