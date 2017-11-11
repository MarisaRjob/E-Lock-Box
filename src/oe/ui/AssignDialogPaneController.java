package oe.ui;

import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.soap.enterprise.sobject.User;
import com.sforce.ws.ConnectionException;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.scene.Node;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import oe.sf.Conn;
import oe.ui.sf.UiAction;

import java.io.IOException;

public class AssignDialogPaneController {
    @FXML
    private ComboBox assignComboBox;
    @FXML
    private Label CheckedActionItem;
    @FXML
    private Label ConnNoteLabel;
    @FXML
    private Button ApplyButton;
    @FXML
    private Button CancelButton;

    public  static UiAction actionitem;
    @FXML
    public void initialize(UiAction action) {
        ConnNoteLabel.setVisible(false);
        actionitem = action;
        CheckedActionItem.setText(action.getName().toString());
        String[]  adminNames = getAdminName();
        for(int count = 0; count < adminNames.length; count ++){
            assignComboBox.getItems().add(adminNames[count]);
        }
    }

    private String[] getAdminName(){
        String query = "select id, name from user where profile.name = 'APT Sys Admin'";
        Conn conn = Conn.getInstance();
        SObject[] admins = new SObject[0];
        try {
            admins = conn.query(query);
        } catch (ConnectionException e) {
            e.printStackTrace();
            ConnNoteLabel.setVisible(true);
        }
        String[] adminNames = new String[admins.length];
        for(int count = 0; count < admins.length; count++){
            adminNames[count] = ((User) admins[count]).getName();
        }
        return adminNames;
    }

    public void handleApplyButtonAction(ActionEvent actionEvent) throws IOException {
        String chosenAdmin = assignComboBox.getValue().toString();
        actionitem.setAssignTo(chosenAdmin);
    }
    public void handleCancelButtonAction(ActionEvent actionEvent) throws IOException {
        ((Node)actionEvent.getSource()).getScene().getWindow().hide();
    }
}
