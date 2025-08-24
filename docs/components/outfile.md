# PHP-SQL

## Outfile documentation

`MariaDB` and `MySQL` only.

```php
use MichaelRushton\SQL\Components\Outfile;
use MichaelRushton\SQL\SQL;

$stmt = SQL::MariaDB->select()
->from("t1")
->intoOutfile("/path/to/file", function (Outfile $outfile)
{

});
// SELECT * FROM t1 INTO OUTFILE '/path/to/file'
```

### characterSet

```php
$outfile->characterSet("utf8");
// CHARACTER SET utf8
```

### fieldsTerminatedBy

```php
$outfile->fieldsTerminatedBy(",");
// FIELDS TERMINATED BY ','
```

### fieldsEnclosedBy

```php
$outfile->fieldsEnclosedBy('"');
// FIELDS ENCLOSED BY '"'
```

### fieldsOptionallyEnclosedBy

```php
$outfile->fieldsOptionallyEnclosedBy('"');
// FIELDS OPTIONALLY ENCLOSED BY '"'
```

### fieldsEscapedBy

```php
$outfile->fieldsEscapedBy("\\");
// FIELDS ESCAPED BY '\'
```

### linesStartingBy

```php
$outfile->linesStartingBy("");
// LINES STARTING BY ''
```

### linesTerminatedBy

```php
$outfile->linesTerminatedBy('\n');
// LINES TERMINATED BY '\n'
```
