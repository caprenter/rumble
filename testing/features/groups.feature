Feature:
When visiting the Groups page

  @headings
  Scenario Outline: I should see the page split into the following sections:.
    Given I am on "/groups"
    Then I should see the heading <named>

	Examples:
	  | named |
    | "Accessible Inclusive Music-AIM" |
    | "All Together Now" |
    | "Bingley Singing For Fun" |
    | "Bingley Tower Bell Ringers" |
    | "Bingley Ukulele Group" |
    | "Bradford Accordion Band" |
    | "Bradford Airedale Youth Choir" |
    | "Cullingworth Community Choir" |
    | "Cullingworth Ukulele Group" |
    | "The Shed Planners Association - BFD" |
    | "Voices of Yorkshire" |

  @headings
  Scenario Outline: Somethings I should not see (anymore)
    Given I am on "/groups"
    Then I should not see the heading <named>

	Examples:
	  | named |
	  | "Little House Guitars" |
    | "TSO Promotions" |
