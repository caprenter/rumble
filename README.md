# Rumble Up the Ryshworth Website

## About
This is a static site that displays at http://bingleymusictown.org.uk/

## Deployment
It is deployed via the docs directory of the main branch of this repo using Github Pages.

### Cron update
We rebuild the site once a day using the GitHub API and [gh-cli](https://cli.github.com/) tool, using a cron job on another server (David's). 

This means our 'Live music today' and 'Make Music Today' data is up to date.

Use the script under 

    /scripts/update_jekyll_sites.sh.example

to set up a cron job. The job is logged in a jekyll_update.log file locally.

This requires a GitHub authentication token which expires every now and again. If you need to replace that token you do it on the server that is running the cron job in the above file.

## Local Development

If you set up your local development environment with Docker, then you also have access to a suite of Behat tests for testing both the live and your local development site.

Alternatively you can just work on the site as you would with a general Jekyll project

Clone the repository

	cd rumble

### With Docker

    docker-compose up
    # NB running it without the -d flag allows to watch jekyll rebuild and see any errors as you work
    # The site will be up on 0.0.0.0:4000

#### Bring down the testing stack 

      docker-compose down

### Without Docker
	
    cd docs/
    # First run only
    bundle install 
    # Bring the site up
    bundle exec jekyll serve
    # The site should be up on 127.0.0.0:4000


# General Site Building

## Add a new gig

### Splash Image

Create a new 16:9 splash image to go at the top of the page and stored it in `assets/images/splashes`

### Band Images
 
Create 4:3 images of each of the bands and store them in `assets/images/bands`

### Update the spreadsheet

Add the gig data to the [Bingley Music Town Live Music spreadsheet](https://docs.google.com/spreadsheets/d/1-Eugy7Wfl0O2dSach2D2dOoE8JEW2tI3sqChuCvLUYg/edit?gid=0#gid=0)


#### Create a new event in the 'Events' tab

NB: The bands should be comma separated in the Events tab, with NO space between them. e.g. band 1,band 2

NB: The images should all be the file names of 4:3 images that are stored in `assets/images/bands`

#### Make sure / add the artists details to the 'Artists' tab

NB: The image should be the file name of a 4:3 image that is stored in `assets/images/bands`

### Download the event data

In /docs/scripts run 
  
    ./fetch_events_data.sh #to fetch the data from the spreadsheet

This fetches 3 csv files (artists.csv, events.csv, venues.csv) and places them in `_data`

### Generate SumUp codes and links

Create a payment link at SumUp - make sure to add a notes field.

* title: The link title. Example: "Rumble #1 Jan 2025 Gurgles + Billy Billy 5P"
* link: a payment url e.g. https://pay.sumup.com/b2c/Q9ARAVHL
* qrcode: an image file in this format: qrcode_sumup_jan2025.png



We generate markdown for each organisation page by using the pagemaster plugin/gem.

This creates pages from a .yml data file, in this case, organisations.yml, by running 

    bundle exec jekyll pagemaster {collection name}

In practice we use: 

    bundle exec jekyll pagemaster organisations
    ## OR with docker:
    docker exec -it jekyll /bin/bash -c 'bundle exec jekyll pagemaster organisations'

This command will generate markdown for views for each item in the collection under ./_{collection name}

To update generated markdown delete that directory as existing files are not updated when pagemaster runs

### Adding an organisation
* Add the data in `_data/organisations.yml`
* Add a logo to `/assets/images/logos`
* Add an image if you have one to `/assets/images/organisations` 
* Build the page with `bundle exec jekyll pagemaster organisations`

### Updating Information about an organisation
* Update the data in `_data/organisations.yml`
* Delete the corresponding entry under `/_organisations` (or the entire _organisations directory)
* rebuild that page(s)with `bundle exec jekyll pagemaster organisations`

## What if my organisation is also a venue

Create an organisation in organisations.yml - you don't need to complete all fields

we use the `jekyll-redirect-from` gem to redirect the org page to a venue page. 
See Cottingley Community Centre as an example.

## Generating individual venue pages
We generate markdown for each venue page by using the pagemaster plugin/gem.

This creates pages from a .yml data file, in this case, venues.yml, by running 

    bundle exec jekyll pagemaster {collection name}

In practice we use: 

    bundle exec jekyll pagemaster venues
    ## OR with docker:
    docker exec -it jekyll /bin/bash -c 'bundle exec jekyll pagemaster venues'

This command will generate markdown for views for each item in the collection under ./_{collection name}

To update generated markdown delete that directory as existing files are not updated when pagemaster runs

### Adding an venue
* Add the data to our Google Spreadsheet - see below.
* Run the scripts/fetch_events_data.sh to fetch the data from the spreadsheet
* The data will now be in `_data/venues.yml`
* Build the page with `bundle exec jekyll pagemaster venues`

### Updating Information about a venue
* Update the data in the Google Spreadsheet
* Run the scripts/fetch_events_data.sh to fetch the data from the spreadsheet
* The data will now be in `_data/venues.yml`
* Delete the corresponding entry under `/_venues` (or the entire _venues directory)
* rebuild that page(s)with `bundle exec jekyll pagemaster venues`

## Internal links between organisations and venues

Put the path and the link text in the venues spreadsheet, and/or in the organisations.yml file.

Examples of both exist. 

## Generating help pages and cards
We generate markdown for each help page by using the pagemaster plugin/gem.

This creates pages from a .yml data file, in this case, help.yml, by running 

    bundle exec jekyll pagemaster {collection name}

In practice we use: 

    bundle exec jekyll pagemaster help

This command will generate markdown for views for each item in the collection under ./_{collection name}

To update generated markdown delete that directory as existing files are not updated when pagemaster runs

### Adding a help
* Add the data in `_data/help.yml`
* Use the order field to help sort the items - lower numbers are first in lists
* Add images to `/assets/images/helps`
* Also create a resized image of max width 310px and with .resized.jpg as part of the file name
* Build the page with `bundle exec jekyll pagemaster help`

### Updating Information about a help
You can edit _help/<pagename> directly.
If you want to regenerate that page from the help.yml data, delete it first then run the pagemaster script.

### Helps on the Front Page
These are limited to the first 3 in the list as order by the order field.

## Images

### Banner images

Main banner images are currently 1280x800px

### Gallery

Gallery Images should be no wider than 1024px

Thumbnails should be 400px square - see below.

Place images in '/assets/images/gallery'

File names of the images are used to generate captions etc.

Underscores in filenames will be replaced by spaces in captions, titles and alt text. 

Run this script in that directory to generate Thumbnails
    
    find . \( -name '*.jpg' -or -name '*.JPG' \) -print0 |  while read -d $'\0' file ; do convert -define jpeg:size=400x400  "$file" -thumbnail 300x300^ -gravity center -extent 300x300  ../thumbnails/"$file" ; done

#### How the gallery works
The gallery is made with [Lightbox for Bootstrap](https://ashleydw.github.io/lightbox/)

There is jekyll config in `config.yml`.

These scripts need to be on the page:

    ## In the header
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    ## Before the </body> tag
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- Lightbox -->
    <script src="https://cdn.jsdelivr.net/npm/bs5-lightbox@1.8.3/dist/index.bundle.min.js"></script>


### Help Images

These images don't need to be wider then 350px.

### Instrument Images

These images don't need to be wider then 350px.

### Logos in the pre-footer area
These are included in the `index.md` file from `_include/gallery.html` and should show all the logos that we have.

## Live music, previous events listings
These are generated from public google spreadsheets:
https://docs.google.com/spreadsheets/d/1-Eugy7Wfl0O2dSach2D2dOoE8JEW2tI3sqChuCvLUYg/edit

Fetch the data with the script:

    #Fetch the data from those sheets.
    cd scripts
    ./fetch_events_data.sh 
    
    #Fetch and commit changes
    ./fetch_events_data.sh update
    
    #Fetch and commit and push changes to origin main
    ./fetch_events_data.sh update push

We use the data to build a live listing page, a previous events page, and to populate the front page with live events today.

## Regular activities

The Regular activities page is generated from a bunch of individual files that give information about an activity on a certain day of the week.

We have individual files for the first week of the month, third thursday and so on.

These are pulled together with scripts.

To add or remove a listing you need to check:
* includes/regular-<day>-<optionally-occurance>.md
* make-today.md
* regular-activities.md

## Make Music Listing (front page)

These are generated from lots of small includes files that contain data about activities that happen on each individual day of the week.

### Christmas / Be Careful Dates etc

`make-today.md` contains a list of dates that can be set to flag a warning on days when regular activities might not happen e.g. Christmas

## Instruments
Data is held in a google spreadsheet. Google forms collect the basic info.
We need to download the instruments sheet as a csv to update the website.
We could make this a public sheet and automate it.
Images are saved and named and then the filename is added to the spreadsheet

# Testing

If you have set up your development environment with Docker then you can run the tests against your local site or the live site using Behat.

We have created a network for the 3 containers (behat, selenium, jekyll), and assigned IP Addresses to each so that the local testing can find the Jekyll site.

The `behat.yml` file contains configuration for the live URL, the local network,and other stuff.

##  Run the tests 

By default the tests will run against a site live on the web as configured in `behat.yml`.

To run against a local development site use the `profile` flag:
 
    --profile=local 

### Optional: Set up a bash alias

Add line to your terminal profile file on your local machine: 
  
     alias behat='docker exec -it behat behat --colors "$@"'

Either reload terminal session or refresh session to make the alias permanent across sessions

### Examples: 
**NB** the examples assume you have set up an alias (see above)
    
    # Get version information
    behat --version 

    # Run all available tests against a LIVE site
    behat 

    # Run all available tests against a local development site
    behat --profile=local 


#### Partial tests

    # Run all tests tagged 'subsection'
    behat --tags @subsection  

    # Run all tests tagged 'javascript' with a javascript enabled browser against a LIVE site.
    behat --tags @javascript  

    # Run all tests tagged 'javascript' with a javascript enabled browser against a LOCAL site.
    behat --profile=local --tags @javascript


## Watch the tests 

You can launch a vnc browser instance in Chrome/Chromium to watch Selenium tests at

     http://localhost:7900 - the password is "secret"

## Writing and contributing tests

Everything is in the `testing` directory. See the Behat docs for more help.


# Contributing
Please fork the repo,and make pull requests from your clone to this one.

## Branches
- `main` holds the most recently deployed code
- `(number)-(name)` branches are working branches where (number) is an issue number and (name) is made up, but has some relation to the issue

## Workflow
* Pick (or create an issue)
* Create a branch (from main if practical) - name the branch (issue number)-(suitable name) e.g. 23-fix-the-footer
* Work on the branch.
* Push to your own fork
* Make a pull request in this repo.