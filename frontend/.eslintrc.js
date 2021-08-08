module.exports = {
    root: true,
    env: {
      node: true,
    },
    extends: ['plugin:vue/essential', '@vue/airbnb', 'plugin:prettier/recommended'],
    parserOptions: {
      parser: 'babel-eslint',
    },
    plugins: ['prettier'],
    rules: {
      'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
      'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
      'import/extensions': 'off',
      'no-shadow': 'off',
      'no-plusplus': 'off'
    },
  };