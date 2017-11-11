package oe.ui;

import com.sforce.soap.enterprise.fault.LoginFault;
import com.sforce.ws.ConnectionException;
import javafx.beans.value.ChangeListener;
import javafx.beans.value.ObservableValue;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.FXMLLoader;
import javafx.geometry.Rectangle2D;
import javafx.scene.Node;
import javafx.scene.Parent;
import javafx.scene.Scene;
import javafx.scene.control.*;
import javafx.scene.layout.GridPane;
import javafx.stage.Screen;
import javafx.stage.Stage;
import oe.sf.Conn;
import oe.util.Preference;
import org.apache.log4j.Logger;

import java.io.IOException;
import java.util.prefs.Preferences;

public class LoginController {
    //log
    private static Logger log = Logger.getLogger(LoginController.class.getName());
    @FXML
    private TextField username;
    @FXML
    private GridPane LoginWindow;
    @FXML
    private PasswordField password;
    @FXML
    private Button Login;
    @FXML
    private CheckBox saveID;
    @FXML
    private Label loginFailedLabel;
    @FXML
    private Label LoginFailedIfAllowLabel;
    private boolean isToUseSandbox;
    private Preferences userPref = Preference.getUserPref();
    private Preferences sysPref = Preference.getSysPref();
    static Stage stage = new Stage();
    @FXML
    public void initialize() {

        LoginWindow.setPrefSize(500, 500);
        loginFailedLabel.setVisible(false);
        LoginFailedIfAllowLabel.setVisible(false);
        username.setText(userPref.get("username",""));
        if(!userPref.get("username","").isEmpty()){saveID.setSelected(true);}

        initLoginButtonText(username.getText());
        username.textProperty().addListener((observable, oldValue, newValue) -> handleUsernameChange(oldValue, newValue));
    }

    private void handleUsernameChange(String oldValue, String newValue) {
        if(CheckIfSandbox(newValue)){
            isToUseSandbox = true;
            Login.setText("Login to Sandbox");
            Login.setStyle("-fx-background-color: aquamarine");
        }else{
            Login.setText("Login to Production");
            Login.setStyle("-fx-background-color: coral");
            isToUseSandbox = false;
        }
    }

    public void handleLoginButtonAction(ActionEvent actionEvent) throws IOException {
        LoginFailedIfAllowLabel.setVisible(false);
        loginFailedLabel.setVisible(false);
        String un = username.getText();

        if (CheckIfcanUseTool()){
            try {
                Conn.createInstance(un, password.getText(), isToUseSandbox);
            } catch (ConnectionException e) {
                loginFailedLabel.setText(((LoginFault) e).getExceptionMessage());
                loginFailedLabel.setVisible(true);
                return;
            }

            //close LoginPage
            ((Node)actionEvent.getSource()).getScene().getWindow().hide();

            //load MainPane.fxml
            showMainPane();

            if (saveID.isSelected()) {
                userPref.put("username", un);
            }
            else {
                userPref.put("username", "");
            }
        }else {
            LoginFailedIfAllowLabel.setVisible(true);   }}
    //UiAction after click Cancel Button
    public void handleCancelButtonAction(ActionEvent actionEvent) throws IOException {
        //close LoginPage
        ((Node)actionEvent.getSource()).getScene().getWindow().hide();
    }


    private void showMainPane() throws IOException {

        Screen screen = Screen.getPrimary();
        Rectangle2D bounds = screen.getVisualBounds();

        stage.setX(bounds.getMinX());
        stage.setY(bounds.getMinY());
        stage.setWidth(bounds.getWidth());
        stage.setHeight(bounds.getHeight());

        Parent root = FXMLLoader.load(getClass().getResource("MainPane.fxml"));
        Scene main_scene = new Scene(root, bounds.getWidth(), bounds.getHeight());
        stage.setTitle("SysAdminTool - " + username.getText() );
        stage.setScene(main_scene);
        stage.show();
    }

    private boolean CheckIfcanUseTool(){
        String wcut = sysPref.get(Preference.WhoCanUseTool,"");
        String un = username.getText();
        un = un.substring(0, un.indexOf(".com")+ 4);
        return wcut.contains(un);
    }

    //check whether the user login with sandbox account(after .com)
    private boolean CheckIfSandbox(String name){
        return name.contains(".com.");
    }

    private void initLoginButtonText(String name){
        if (CheckIfSandbox(name)) {
            Login.setText("Login to sandbox");
            Login.setStyle("-fx-background-color: aquamarine;");
            isToUseSandbox = true;
        }else {
            Login.setText("Login to production");
            Login.setStyle("-fx-background-color: coral");
            isToUseSandbox = false;
        }
    }


}
