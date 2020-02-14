# pigripper
Back-shop tool to rip and reformat data from old database to JSON output

This tool was created to assist in the migration of a media site with a formidable backlog of data (thousands of rows); each article was attributed to a user in the database, but the data was dirty; many needed reattribution to existing authors.

It is not intended to be particularly secure, or error-tolerant as time and core functionality were the defining factors.  The purpose was to save time in the migration, which it performed with aplomb.  It was coded within a few hours, most of which was spent waiting for testing.  It's designed to be 
  - extendible, 
  - re-usable on similar sites, which it was, successfully
  - configurable, since I didn't have all of the replacements or all of the data in hand.

It is provided as a demonstration only.  It is unlikely to work practicably in any other use case since the CMS it was created to interface with was bespoke.
