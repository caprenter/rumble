Feature:
When visiting the homepage

  @header_menu
	Scenario: I am not logged on I should see the main menu.
    Given I am on "/"
    Then I should see the link "Home" in the "navigation" region	
		And I should see the link "Join" in the "navigation" region
		And I should see the link "Meet" in the "navigation" region
		And I should see the link "Help" in the "navigation" region
		And I should see the link "People" in the "navigation" region

  @assets
	Scenario: I am not logged on I should see working images and links
  	Given I am on "/"
		And the images should not return 404
		And the links should not return 404
	
	@intro
	Scenario: I am not logged on I should see the introductory text
  	Given I am on "/"
		Then I should see "Rumble Up Bingley brings together the people that care about music in our area, to make sure there are great musical opportunities for everyone now, and into the future."

 @footer_menu
	Scenario: I am not logged on I should see the footer menu.
    Given I am on "/"
    Then I should see the link "Contact"
    And I should see the link "Home"
	And I should see the link "Join"
	And I should see the link "Meet"
	And I should see the link "Help"
	And I should see the link "People"
	And I should see the link "Music Groups"
	And I should see the link "Music Month - November 2023"
	And I should see the link "Regular Activities"
	And I should see the link "Tuition"
	And I should see the link "Instruments"
	And I should see the link "Effects Library"
	And I should see the link "Upcoming Events"
	And I should see the link "Previous Events"
	And I should see the link "Venues"
	And I should see the link "Resources"
	And I should see the link "Gallery"
	And I should see the link "Contact"

 
  #@search
  #Scenario: I am not logged on I can see the search button
  ##  Given I am on the homepage
  #  Then I should see the "Search" button
		
