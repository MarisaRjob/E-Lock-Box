package oe.sf;

import com.sforce.soap.enterprise.SaveResult;
import com.sforce.soap.enterprise.sobject.SObject;
import com.sforce.ws.ConnectionException;
import oe.util.Assert;
import org.apache.log4j.Logger;

import java.util.ArrayList;
import java.util.Arrays;
import java.util.Hashtable;

public class Inserter<T extends SObject> extends Upserter<T> {

    public Inserter(T[] sObjects) {
        super(sObjects);
    }


    @Override
    public SaveResult[] perform(SObject[] sObjects) throws ConnectionException {
        return Conn.getInstance().insert(sObjects);
    }

}
