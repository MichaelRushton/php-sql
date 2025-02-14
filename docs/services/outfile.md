# Outfile

```php
use MichaelRushton\SQL\Services\Outfile;

$stmt->intoOutfile($path, function (Outfile $outfile)
{

});
```

## API reference

### characterSet
```php
$outfile->characterSet($name);
```

### fieldsTerminatedBy
```php
$outfile->fieldsTerminatedBy($string);
```

### fieldsEnclosedBy
```php
$outfile->fieldsEnclosedBy($char);
```

### fieldsOptionallyEnclosedBy
```php
$outfile->fieldsOptionallyEnclosedBy($char);
```

### fieldsEscapedBy
```php
$outfile->fieldsEscapedBy($char);
```

### linesStartingBy
```php
$outfile->linesStartingBy($string);
```

### linesTerminatedBy
```php
$outfile->linesTerminatedBy($string);
```