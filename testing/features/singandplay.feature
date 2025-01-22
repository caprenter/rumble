Feature:
When visiting the pages in the Sing and Play section

  @funders
	Scenario: I should see relevant funders acknowledged.
    Given I am on "/tuition"
	    Then I should see the text "the 1887 Alfred Sharp Fund" in the "listings" region

@menu
	Scenario: I am not logged on I should see everything on the SIng & PLay menu.
    Given I am on "/"
    And I click "Sing & Play"
    Then I should see the link "Music Groups"
    And I should see the link "Regular Activities"
    And I should see the link "Tuition"
    And I should see the link "Instruments"
    And I should see the link "Effects Library"

