-- Update color scheme in business_settings table
-- Light mode: Black and White
-- Dark mode: Black and Gold (handled by CSS)

UPDATE business_settings
SET value = '{"primary":"#000000","secondary":"#333333","primary_light":"#ffffff","panel-sidebar":"#000000","app-primary":"#000000","app-secondary":"#333333"}'
WHERE type = 'colors';
