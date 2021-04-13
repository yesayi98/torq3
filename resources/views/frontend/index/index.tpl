<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{$controller->name}</title>
</head>
<body>
{block name='app.body'}
    <ul>
    {foreach $products as $product}
        <li>{$product->getName()} {$product->getPrice()}</li>
    {/foreach}
    </ul>
{/block}
</body>
</html>
