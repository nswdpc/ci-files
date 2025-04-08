# Workflows

## Bundle workflows

### silverstripe.yml

Purpose: perform automated refactoring to the assigned PHP version with SS code quality

+ Runs on PHP: 8.1
+ Includes php-cs-fixer
+ Rector PHP set: php81
+ Rector sets: SilverstripeSetList::CODE_QUALITY

### silverstripe_5_81.yml

Purpose: perform automated refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.1
+ Includes php-cs-fixer
+ Rector PHP set: php81
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52

### silverstripe_5_83.yml

Purpose: perform automated refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.3
+ Includes php-cs-fixer
+ Rector PHP set: php83
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52

### silverstripe_5_84.yml

Purpose: perform automated refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.4
+ Includes php-cs-fixer
+ Rector PHP set: php84
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52


## Standalone workflows

### rector.silverstripe.yml

Purpose: perform automated rector only refactoring to the assigned PHP version with SS code quality

+ Runs on PHP: 8.1
+ Rector PHP set: php81
+ Rector sets: SilverstripeSetList::CODE_QUALITY

### rector.silverstripe_5_81.yml

Purpose: perform automated rector only refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.1
+ Rector PHP set: php81
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52

### rector.silverstripe_5_83.yml

Purpose: perform automated rector only refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.3
+ Rector PHP set: php83
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52

### rector.silverstripe_5_84.yml

Purpose: perform automated rector only refactoring to the assigned PHP version with SS code quality and SS UP_TO_SILVERSTRIPE_52

+ Runs on PHP: 8.4
+ Rector PHP set: php84
+ Rector sets: SilverstripeSetList::CODE_QUALITY, SilverstripeLevelSetList::UP_TO_SILVERSTRIPE_52

### phpstan.silverstripe.yml

Purpose: perform static analysis on the assigned PHP version

+ Runs on PHP: 8.1

### phpstan.silverstripe_83.yml

Purpose: perform static analysis on the assigned PHP version

+ Runs on PHP: 8.3

### phpstan.silverstripe_84.yml

Purpose: perform static analysis on the assigned PHP version

+ Runs on PHP: 8.4

### php-cs-fixer.yml

Purpose: perform code standards fixing on the assigned PHP version

+ Runs on PHP: 8.1

### php-cs-fixer_83.yml

Purpose: perform code standards fixing on the assigned PHP version

+ Runs on PHP: 8.3

### php-cs-fixer_84.yml

Purpose: perform code standards fixing on the assigned PHP version

+ Runs on PHP: 8.4
