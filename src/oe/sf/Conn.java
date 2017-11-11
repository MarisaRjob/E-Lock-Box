package oe.sf;

import com.sforce.soap.enterprise.Connector;
import com.sforce.soap.enterprise.EnterpriseConnection;
import com.sforce.soap.enterprise.QueryResult;
import com.sforce.soap.enterprise.SaveResult;
import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.ws.ConnectionException;
import com.sforce.ws.ConnectorConfig;
import oe.util.Preference;
import org.apache.log4j.Logger;


public class Conn {

    private static Logger log = Logger.getLogger(Conn.class.getName());

    private static Conn CONN;
    private boolean isSandboxLogin;
    private boolean isConnected;


    private Conn() { }

    private EnterpriseConnection connection;

    public boolean isSandboxLogin() {
        return isSandboxLogin;
    }

    /**
     * Create connection to Salesforce
     * @param username cannot be null
     * @param password cannot be null
     * @param useSandboxEndpoint determine SOAP endpoint to use depending on environment
     * @return null is allowed
     */
    public static Conn createInstance(String username, String password, boolean useSandboxEndpoint) throws ConnectionException {
        Conn conn = new Conn();
        conn.isSandboxLogin = useSandboxEndpoint;

        ConnectorConfig config = new ConnectorConfig();
        config.setUsername(username);
        config.setPassword(password);

        String sep = Preference.mustGetSysSetting(Preference.sf_sandboxEndPoint, "Sys preferences missing setting: " + Preference.sf_sandboxEndPoint);
        String pep = Preference.mustGetSysSetting(Preference.sf_prodEndPoint, "Sys preferences missing setting: " + Preference.sf_sandboxEndPoint);
        config.setServiceEndpoint(useSandboxEndpoint ? sep : pep);

        try {
            conn.connection = Connector.newConnection(config);

            log.debug("Username: "+config.getUsername());
            CONN = conn;
            conn.isConnected = true;

        } catch (ConnectionException e1) {
            conn.isConnected = false;
            log.info(e1);
            throw e1;
        }

        return conn;
    }

    private static SaveResult[] updateOrInsert(boolean isForInsert, SObject[] sObjects) throws ConnectionException {

        SaveResult[] results;
        try {
            results = isForInsert ? CONN.connection.create(sObjects) : CONN.connection.update(sObjects);
        } catch (ConnectionException ce) {
            log.error(ce);
            throw ce;
        }

        return results;
    }

    public static SaveResult[] update(SObject[] sObjects) throws ConnectionException {

       return  updateOrInsert(false, sObjects);
    }

    public static SaveResult[] insert(SObject[] sObjects) throws ConnectionException {
        return updateOrInsert(true, sObjects);
    }


    /**
     * Return connection singleton
     * @return non-null connection, might be connected
     */
    public static Conn getInstance() {
        //todo: should throw exception
        //if (CONN == null || !CONN.isConnected) throw new ConnectionException("Not connected to Salesforce");
        return CONN;
    }

    /**
     * Run query in Salesforce
     * @param query
     * @return query result - can be empty but cannot be null
     */
    public SObject[] query(String query) throws ConnectionException {
        try {
            QueryResult queryResults = connection.query(query);
            return queryResults.getRecords();
        } catch (Exception e) {
            log.error(e);
            throw e;
        }
    }

    public static String checkIfStringOverLength(String showString){
        if(showString == null || showString.length() <= 0){
            return "";
        }else{
            if( showString.length() > 20000){
                return showString.split("",20000)[0];

            }
            else{return showString; }}
    }


}





