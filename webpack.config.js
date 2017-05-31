const path = require('path');

module.exports = {
    // This is the "main" file which should include all other modules
    entry: {
        admin: './static/src/admin.js',
        home: './static/src/home.js',
        detail: './static/src/detail.js'
    },
    // Where should the compiled file go?
    output: {
        // To the `dist` folder
        path: path.resolve(__dirname, 'static/dist'),
        // With the filename `build.js` so it's dist/build.js
        filename: '[name]-bundle.js'
    },
    module: {
        // Special compilation rules
        loaders: [
            {
                // Ask webpack to check: If this file ends with .js, then apply some transforms
                test: /\.js$/,
                // Transform it with babel
                loader: 'babel-loader',
                // don't transform node_modules folder (which don't need to be compiled)
                exclude: /node_modules/
            }
        ]
    }
}