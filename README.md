# Afvalkalender

## Installation
1. Clone this repository
2. Run `composer install`
3. Run `yarn` if you have Yarn installed. Otherwise you can use `npm install`
4. Navigate to your website with the afvalkalender
5. Fill in your zipcode, housenumber and select the amount of days you want to see
6. Have fun

## Class documentation
The classname is AfvalKalenderController and is having the following options

```
postalcode
housenumber
suffix
country
```

## Limitations
Because this application uses the API of mijnafvalwijzer.nl there is a chance that the data is not available. This is because the data is not supplied to mijnafvalwijzer.nl. If there are none collection days, the message "Er zijn geen ophaaldagen bekend" will show up.