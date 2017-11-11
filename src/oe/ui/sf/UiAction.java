package oe.ui.sf;

/**
 * Created by rui.ma on 9/14/2017.
 */

import com.sforce.soap.enterprise.sobject.Action__c;
import com.sforce.soap.enterprise.sobject.Attachment;
import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.ws.ConnectionException;
import oe.sf.Conn;
import oe.sf.Utility;
import oe.ui.MainPaneController;

import java.text.SimpleDateFormat;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.Hashtable;

public class UiAction {
    private Action__c action;
    private Attachment[] attachments = new Attachment[0];
    private static Action__c[] actions;
    public UiAction(Action__c a) {
        action = a;
    }

    private boolean checkbox;
    public boolean isCheckbox() {return checkbox;}
    public void setCheckBox(boolean value) {
        checkbox = value;
    }

    public String getName() {
      return Conn.checkIfStringOverLength(action.getName());

    }
    public String getCreatedBy(){ return action.getCreatedBy().getName(); }
    public String getSubject__c() {return action.getSubject__c();}
    public String getStatus__c(){ return Conn.checkIfStringOverLength(action.getStatus__c()); }
    public String getBody(){return Conn.checkIfStringOverLength(action.getDescription__c());}
    public String getAssign_To__c(){ return action.getAssigned_To__c(); }
    public String getDeployed_to_Sandbox__c(){ return action.getDeployed_to_Sandbox__c(); }
    public String getStart_Date__c(){ return action.getStart_Date__c() == null? "": new SimpleDateFormat("MM/dd").format(action.getStart_Date__c().getTime()); }
    public String getCreatedDate(){ return new SimpleDateFormat("MM/dd/yy").format(action.getCreatedDate().getTime()); }
    public String getPriority__c(){ return action.getPriority__c(); }

    public String getId(){
        return action.getId();

    }
    private void setAttachments(ArrayList<SObject> attachments) {
        this.attachments = new Attachment[attachments.size()];
        attachments.toArray(this.attachments );
    }

    public String getAttachmentAsNumber(){

        StringBuilder rtnValues = new StringBuilder();
        for(int count=1; count <= attachments.length; count++){
            rtnValues.append(count).append(count == attachments.length ? "" : ",");
        }
        return rtnValues.toString();
    }

    public void setAssignTo(String adminname){
        action.setAssigned_To__c(adminname);
       // Conn.update(Sobject);
    }
    /**
     *
     * @param query must be action query, cannot be null
     * @return empty arraylist if no attachment match with action
     */
    public static ArrayList<UiAction> queryForActionTab(String query) {
        Conn conn = Conn.getInstance();
        SObject[] actions = new SObject[0];
        try {
            actions = conn.query(query);
        } catch (ConnectionException e) {
            e.printStackTrace();
            MainPaneController.ConnNoteLabel.setVisible(true);

        }
        if (actions.length <= 0) return new ArrayList<>();

        String actionIds = Utility.getCsvId(actions);
        String atttachmentQuery = "SELECT ParentId, Name, ContentType FROM Attachment where parentid in  (${ids})".replace("${ids}", actionIds);
        SObject[] attachments = new SObject[0];
        try {
            attachments = Conn.getInstance().query(atttachmentQuery);
        } catch (ConnectionException e) {
            e.printStackTrace();
            MainPaneController.ConnAttachNoteLabel.setVisible(true);

        }

        return mapAttachment2Aaction(actions, attachments);
    }

    /**
     *
     * @param actions
     * @param attachments can be null
     * @return empty arraylist if there is no attachment
     */
    //todo: must have junit test
    private static ArrayList<UiAction> mapAttachment2Aaction(SObject[] actions, SObject[] attachments) {

        Hashtable<String, ArrayList<SObject>> ha = new Hashtable<>();
        Arrays.stream(attachments).forEach(a -> {
            String pid = ((Attachment)a).getParentId();
            ArrayList al = ha.get(pid);
            if (al == null) al = new ArrayList<SObject>();
            al.add(a);
            ha.put(pid, al);
        });

        ArrayList<UiAction> rtn = new ArrayList<>();
        Arrays.stream(actions).forEach(a -> {
            UiAction ua = new UiAction((Action__c) a);
            rtn.add(ua);

            if (ha.containsKey(a.getId())) {
                ua.setAttachments(ha.get(a.getId()));
            }
        });
       return rtn;
    }


    /**
     * Convert arg actions into UiAction object array
     * @param actions must be instanceof Action__c; can be null or empty
     * @return empty array if actions arg is empty or null
     */
    public static UiAction[] toArray(SObject[] actions) {
        if (actions == null || actions.length == 0) {
            return new UiAction[0]; }

        UiAction[] returnArray = new UiAction[actions.length];
        int counter = 0;
        for (SObject so: actions) {

            returnArray[counter] = new UiAction((Action__c)so);
            counter++; }

        return returnArray;
    }

}
