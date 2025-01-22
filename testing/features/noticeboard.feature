Feature:
When visiting the Noticeboard page

  @headings
   Scenario Outline: I should see the page split into the following sections:.
    Given I am on "/noticeboards"
    Then I should see the heading <named>

	Examples:
	  | named |
	  | "Noticeboards" |
