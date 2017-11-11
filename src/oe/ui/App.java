package oe.ui;

import javafx.application.Application;
import javafx.fxml.FXMLLoader;
import javafx.scene.Group;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.stage.Stage;
import oe.util.Preference;
import org.apache.log4j.Logger;


public class App extends Application{

    private static Logger log = Logger.getLogger(App.class.getName());

    @Override
    public void start(Stage primaryStage) throws Exception{

        Parent root = FXMLLoader.load(getClass().getResource("Login.fxml"));
        primaryStage.setTitle("Login");

        try {
            Class.forName("org.hsqldb.jdbcDriver" );
            log.info("info log");
        } catch (Exception e) {
            log.error(e);
            return;
        }

       // Connection c = DriverManager.getConnection("jdbc:hsqldb:hsql://localhost/xdb", "sa", "");

        primaryStage.setScene(new Scene(root, 600, 500));
        primaryStage.show();

    }



    public static void main(String[] args) {

        Preference.importPrefIfFileExistAndDelete(Preference.getUserPref(), "user.setting.xml");
        Preference.importPrefIfFileExistAndDelete(Preference.getSysPref(), "sys.setting.xml");

        launch(args);
    }


    //learning goals: junit, log4j, HyperSQL, JDBC driver (maybe JOOQ), javafx, salesforce soap api, salesforce sooql

    //version 0.1
    //a. login - allow authorized user to login to both prod and sandbox environment
    //b. after login - show open action items

    //details
    //a. login
    //1. open login dialog box ask for username, password
    //2. create "Setting" menu and provide functionality to export user, and system preference to user.setting.xml and sys.setting.xml
    //3. if either setting.xml exist, load pref accordingly. Delete the file when done.
    //4. determine if user is allowed to use tool - check against system pref {UserCanUseTool, "rui.ma@openedgepay.com"}. check everything up to .com
    //5. Login dialog
    //6. if use check "Save ID". This is save to user pref
    //7. if username not end with .com, this is for sandbox. Endpoint needs to change depending env.

    //b. after login - show open action items
    //todo: missing checkboxes, body, testing for long text for subject and body.
    //todo: changes for UiAction column: V | A | CS | AC <== all links, hover to get tips: A = Assign,  Change Status, AC = Auto Complete,  V view
    //todo: Attachment: remove last commas, all links, hover to view name of attachment
    //todo: remove "more detail"
    //todo: View = open up browser to view action items. if no checkbox is check, open current action item (on the same row). If multiple checkboxes are check, open all action items
    //todo: Assign = open up dialog box to allow me to assign to another admin ( get all admins, and save ids in db)
    //todo: bug: CreateDate data missing
    //todo: move action related components to ActionTab



}
