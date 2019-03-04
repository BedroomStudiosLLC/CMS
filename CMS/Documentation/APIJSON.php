{
    "CMS": [
    { "Name": "Bootstrap Alert Types", "URL": "/CMS/HelperClasses/BootstrapAlertType.php", "Class": "BootStrapAlertType",
    "Returns": "string", "Description": "These constants return the bootstrap alert color classes text:", "Type": "CONSTANT",
    "List" : [{"Item": "BootstrapAlertType::PRIMARY"}, {"Item": "BootstrapAlertType::SECONDARY"}, {"Item": "BootstrapAlertType::SUCCESS"}, {"Item": "BootstrapAlertType::DANGER"}, {"Item": "BootstrapAlertType::WARNING"}, {"Item": "BootstrapAlertType::INFO"}, {"Item": "BootstrapAlertType::LIGHT"}, {"Item": "BootstrapAlertType::DARK"}],
    "InputNum": "1", "Show": "True", "Syntax": "BootstrapAlertType::VALUE", "PlaceHolders": [{"0": "BootstrapAlertType::DARK", "Type": "CONSTANT"}] },
    { "Name": "HTML Alerts", "URL": "/CMS/PartialHTML/HTMLAlerts.php", "Class": "HTMLAlerts",
    "Returns": "HTML", "Description": "This will return a full bootstrap alert. You need to give a message and a BootStrapAlertType constant.", "Type": "FUNCTION", "FunctionName": "HTMLAlerts::GetHTMLAlert",
    "InputNum": "2", "Show": "True", "Syntax": "HTMLAlerts::GetHTMLAlert(MESSAGE, BOOTSTRAPALERTTYPE)", "PlaceHolders": [{"0": "This is a description"}, {"1": "BootstrapAlertType::DARK", "Type": "CONSTANT"}] }
    ]
}