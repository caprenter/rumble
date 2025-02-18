# Rumble Up the Ryshworth Website

## About
This is a static site that displays at https://rumbleupbingley.co.uk/

## Deployment
It is deployed via the docs directory of the main branch of this repo using Github Pages.

### Cron update
We rebuild the site once a day using the GitHub API and [gh-cli](https://cli.github.com/) tool, using a cron job on another server (David's). 

This means that our What's On data stays up to date as we pass and event date.

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

You need to:

* [Splash Image](#splash-image)
* [Band Images](#band-images)
* [Update the spreadsheet](#update-the-spreadsheet)
* [Download the event data](#download-the-event-data)
* [Create an event page](#create-an-event-page)

### Splash Image

Create a new 16:9 splash image to go at the top of the page and store it in `assets/images/splashes`

### Band Images
 
Create 4:3 images of each of the bands and store them in `assets/images/bands`

### Update the spreadsheet

Add the gig data to the [Bingley Music Town Live Music spreadsheet](https://docs.google.com/spreadsheets/d/1-Eugy7Wfl0O2dSach2D2dOoE8JEW2tI3sqChuCvLUYg/edit?gid=0#gid=0)


#### Create a new event in the 'Events' tab

**NB** The bands should be comma separated in the Events tab, with NO space between them. e.g. band 1,band 2

**NB** The images should all be the file names of 4:3 images that are stored in `assets/images/bands`

**NB** The Description MUST contain the word "Rumble"!!

#### Make sure / add the artists details to the 'Artists' tab

**NB** The image should be the file name of a 4:3 image that is stored in `assets/images/bands`

### Download the event data

In /docs/scripts run 
  
    ./fetch_events_data.sh #to fetch the data from the spreadsheet

This fetches 3 csv files (artists.csv, events.csv, venues.csv) and places them in `_data`

**NB** This is enough to update the What's on listing on the home page. BUT we also need an event page...

### Create an event page 

Copy an existing event from the `/events' directory and rename it in mmm-yyyyy format. 

Edit the front matter, updating the `title`, `date`, and `cover` items.

The page title that overlays the splash/cover image is generated from the `title` and the (formated) `date` field 

Next update the SumUp codes (see below) 

#### SumUp codes and links

Create a payment link at SumUp - make sure to add a notes field.

* title: The link title. Example: "Rumble #1 Jan 2025 Gurgles + Billy Billy 5P"
* link: a payment url e.g. https://pay.sumup.com/b2c/Q9ARAVHL
* qrcode: an image file in this format: qrcode_sumup_jan2025.png

Update the `sumupLink` in the front matter with the link.


## Images

### Banner/Splash images

Main banner images are 16:9 aspect ratio .jpg files (if you need dimensions try 1280x800px)

Handy resize code

     find . -name '*.jpg' -size +100k  -print0 | while read -d $'\0' file ; do smartresize "$file" 1280 . ; done


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


### Band Images

Band images are 4:3 aspect ratio.

## Previous events listings
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