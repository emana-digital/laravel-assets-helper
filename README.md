# Assets Helper 
Laravel Blade helpers for a easy integration with <a href="https://github.com/ztoben/assets-webpack-plugin">assets-webpack-plugin</a>.
For now, `v1.0.0` will only work with a compatible configuration. If you need more personalization, let me now, or just send a pull-request.
The `assets.json` file is expected to be in `/public/assets/` directory.

### How to use
1 - Configure `assets-weback-plugin`
```javascript
new AssetsPlugin({
    manifestFirst: true,
    useCompilerPath: true,
    fullPath: true,
    includeAllFileTypes: true,
    keepInMemory: false,
    entrypoints: true,
    filename: 'assets.json'
})
```
2 - Add `emana-digital/laravel-assets-helper` in your repositories
```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "https://github.com/emana-digital/laravel-assets-helper"
    }
  ]
}
```
3 - Install
```shell script
composer require emana-digital/laravel-assets-helper
```
4 - Call helper in a blade view with the name of entrypoint
```html
<html>
<head>
    <title>My Laravel SPA</title>
    @assetsHelperLinkTags('website')
</head>
<body>

@assetsHelperScriptTags('website')
</body>
</html>
```

